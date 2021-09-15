<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
use App\Models\AmountAssigned;
use App\Models\CashRegister;
use App\Models\CheckType;
use App\Models\ExpenseType;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;

class CashRegisterRepository implements ICashRegisterRepository
{

    public function all()
    {
        return CashRegister::orderBy('id','desc')->paginate(10);
    }
    public function registersXUser($id)
    {
        $cashRegister = CashRegister::where('idDestination',$id)->orWhere('idDestination',1)->orderBy('id','desc')->paginate(10);
        return $cashRegister;
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        //elimina el registro y me devuelve el monto que tenia asignado
       $cashRegister = CashRegister::find($id);
       $amount = $cashRegister->account;
        $cashRegister->delete();
        return $amount;
    }

    public function getDetailRegister($id)
    {
        return CashRegister::where('id', $id)->get();
    }
    public function getRegisterWithVoucher($id)
    {

        $cashRegister=  CashRegister::find($id);
        return  array(
            'cashRegister' => $cashRegister,
            'ExpenseType'=> ExpenseType::find($cashRegister->registrable->expense_type_id),
            'CheckType'=> CheckType::find($cashRegister->registrable->check_type_id),
        );
    }

    public function getRegistersXUser($id)
    {
        // TODO: Implement getRegistersXUser() method.
        return CashRegister::whereHasMorph(
            'registrable',
            [AmountAssigned::class, Voucher::class],
            function (Builder $query, $type)use ($id){
                //cuando el destino fue el usuario logeado
                $query->where('idDestination', '=',$id);

                //cuando el voucher fue hecho por el
                if ($type === 'App\Models\Voucher') {
                    $query->orWhere('user_id', '=', $id);
                }
            })->orderBy('id','desc')->paginate(10);
    }

    public function getRegistersXCajaChica($id)
    {
        // TODO: Implement getRegistersXUser() method.
        return CashRegister::whereHasMorph(
            'registrable',
            [AmountAssigned::class, Voucher::class],
            function (Builder $query, $type)use ($id){
                //cuando el destino fue el usuario logeado
                $query->where('idDestination', '=',$id);

                //cuando el voucher fue hecho por el
                if ($type === 'App\Models\Voucher') {
                    $query->orWhere('user_id', '=', $id);
                }
                //cuando el amount fue hecho por el
                if ($type === 'App\Models\AmountAssigned') {
                    $query->orWhere('user_id', '=', $id);
                }
            })->orderBy('id','desc')->paginate(10);
    }


    public function changeStateType($id)
    {
        $cashRegister = CashRegister::find($id);
        $cashRegister->type = 'aprobado';
        $cashRegister->save();
    }
}
