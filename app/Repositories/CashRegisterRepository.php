<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
use App\Models\AmountAssigned;
use App\Models\CashRegister;
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
        // TODO: Implement delete() method.
    }

    public function getDetailRegister($id)
    {
        return CashRegister::where('id', $id)->get();
    }
    public function getRegisterWithVoucher($id)
    {

        $cashRegister=  CashRegister::find($id)->registrable;
        $modelo = array(
            'cashRegister' => $cashRegister,
            'test'=>2
        );
        return $modelo;
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


}
