<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
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
        $cashRegister = CashRegister::whereHas('box', function (Builder $query) {
            $query->whereHas('users', function (Builder $users){
                $users->where('user_type_id','=','3');//3 es el tipo de usuario caja chica
            })->get();
        })->get();


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
