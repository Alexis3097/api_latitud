<?php

namespace App\Repositories;
use App\Models\CheckType;
use App\Models\ExpenseType;
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
                'user_id'=>$data->user_id,
                'expense_type_id'=>$data->expense_type_id,
                'check_type_id'=>$data->check_type_id,
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
                'type'=>'pagado',
                'user_id'=>$data->user_id,
            ]);
            DB::commit();
        }catch (\Exception $e){
//            global $foto;
            DB::rollback();
//            if(!is_null($foto)){
                cloudinary()->destroy($foto->getPublicId());
//            }
        }
        return $voucher;
    }
    public function show($id){
        return Voucher::find($id);
    }
    public function update($data, $id){
        $voucher = Voucher::find($id);
        $voucher->fill($data);
        return $voucher->save();
    }
    public function delete($id){
        return Voucher::find($id)->delete();
    }

    public function getExpenseType()
    {
        return ExpenseType::all();
    }

    public function getCheckType()
    {
        return CheckType::all();
    }
}
