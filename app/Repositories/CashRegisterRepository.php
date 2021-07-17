<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
use App\Models\AmountAssigned;
use App\Models\CashRegister;
use Illuminate\Database\Eloquent\Builder;

class CashRegisterRepository implements ICashRegisterRepository
{

    public function all()
    {
//        $test =  AmountAssigned::create([
//            'user_id'=>1,
//            'amount'=>500,
//            'amount_status'=>true,
//    ]);
//        $test->CashRegister()->create([
//            'user_id' =>1,
//            'account'=>500,
//            'type'=>'pagado',
//        ]);

        return CashRegister::with('user')->orderBy('id','desc')->paginate(10);

    }
    public function registersCajaChia()
    {
        $cashRegister = CashRegister::whereHas('box', function (Builder $query) {
            $query->whereHas('user', function (Builder $users){
                //3 es el tipo de usuario caja chica y 1 es admin
                $users->where('user_type_id','=',3)->orWhere('user_type_id','=','1');
            });
        })->orderBy('id','desc')->paginate(10);


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
}
