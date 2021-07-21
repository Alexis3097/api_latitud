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
        return CashRegister::orderBy('id','desc')->paginate(10);
    }
    public function registersCajaChia()
    {

        $cashRegister = CashRegister::find(1);
//            ->orderBy('id','desc')->paginate(10);
//        $test = $cashRegister->registrable;

        return $cashRegister->registrable;
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
