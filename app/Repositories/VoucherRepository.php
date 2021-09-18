<?php

namespace App\Repositories;
use App\Events\VoucherEvent;
use App\Models\CashRegister;
use App\Models\CheckType;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Voucher;
use App\IRepositories\IVoucherRepository;
use Illuminate\Support\Facades\DB;

class VoucherRepository implements IVoucherRepository
{

    public function all(){
        return Voucher::paginate(10);
    }
    public function create($data)
    {
        $foto = null;
        $voucher = null;
        try{
            global $foto;
            global $voucher;
            DB::beginTransaction();
            if(!is_null($data->file('file'))){
                $foto = cloudinary()->upload($data->file('file')->getRealPath());
            }
            $voucher = Voucher::create([
                'user_id'=>$data->user_id,//el usuario que esta mandando el dinero
                'expense_type_id'=>$data->expense_type_id,
                'check_type_id'=>$data->check_type_id,
                'destination_id'=>$data->idDestinatario,
                'concept'=>$data->concept,
                'amount'=>$data->amount,
                'photo'=>$foto == null ? $foto : $foto->getSecurePath(),
                'photoId'=>$foto == null ? $foto : $foto->getPublicId(),
                'Store'=>$data->Store,
                'RFC'=>$data->RFC,
                'date'=>$data->date
            ]);
            //guardar en el registro de actividades cuanto se le dio - cash_register
            $voucher->CashRegister()->create([
                'account'=>$data->amount,
                'type'=> 'en revision',
                'user_id'=>$data->user_id,//el usuario que mando dinero
                'idDestination'=>$data->idDestinatario,//debe ser a quien le esta dando el dinero
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            $voucher = null;
            if(!is_null($foto)){
                cloudinary()->destroy($foto->getPublicId());
            }
        }
        if(!is_null($voucher)){
            $user = User::find($data->user_id);
            $objectVouvher = array(
                'remitente' => $user->name,
                'idDestinatario'=> $data->idDestinatario,
                'register_id'=>$voucher->CashRegister->id,
            );
           event(new VoucherEvent($objectVouvher));
        }
        return $voucher;
    }
    public function show($id){
        return Voucher::find($id);
    }
    public function update($data, $id){
        $foto = null;
        $voucher = null;
        try{
            global $foto;
            global $voucher;
            DB::beginTransaction();
            $voucher = Voucher::find($id);
            if(!is_null($data->file('file'))) {
                $foto = cloudinary()->upload($data->file('file')->getRealPath());
                //elimino la foto vieja si es que tiene
                if (!is_null($voucher->photoId)) {
                    cloudinary()->destroy($voucher->photoId);
                }
                //actualizo el url de la nueva fotp
                $voucher->photo = $foto->getSecurePath();
                $voucher->photoId = $foto->getPublicId();
            }
            //actualizo los datos del voucher
            //no actualizo quien mando el dinero
            $voucher->expense_type_id = $data->expense_type_id;
            $voucher->check_type_id = $data->check_type_id;
            $voucher->destination_id = $data->idDestinatario;
            $voucher->concept = $data->concept;
            $voucher->amount = $data->amount;
            $voucher->date = $data->date;
            $voucher->Store = $data->Store;
            $voucher->RFC = $data->RFC;
            $voucher->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            if(!is_null($foto)){
                cloudinary()->destroy($foto->getPublicId());
            }
            $voucher = $e;
        }
        if(!is_null($voucher)){
            //si se actualizo el voucher hay que actualizar el registro
            $cashRegister = CashRegister::where('registrable_id',$voucher->id)->where('registrable_type','App\Models\Voucher')->first();
            $cashRegister->account = $voucher->amount;
            $cashRegister->idDestination = $voucher->destination_id;
            $cashRegister->save();
        }
        return $voucher;
    }
    public function delete($id){
        $voucher = Voucher::find($id);
        if(!is_null($voucher)){
            //eliminar el register
            $cashRegister = CashRegister::where('registrable_id',$voucher->id)->where('registrable_type','App\Models\Voucher')->first();
            $cashRegister->delete();
            //eliminar la foto si tiene
            if(!is_null($voucher->photoId)){
                cloudinary()->destroy($voucher->photoId);
            }
            $voucher->delete();
            //se elimino
            return true;
        }
        //no se elimino
        return false;
    }

    public function getExpenseType()
    {
        return ExpenseType::all();
    }

    public function getCheckType()
    {
        return CheckType::all();
    }


    public function changeStatusApprove($id)
    {
        $voucher = Voucher::find($id);
        $voucher->approve = true;
        $voucher->save();
    }
}
