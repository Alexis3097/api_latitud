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
//        $cajaChica = CashRegister::whereHas('box', function (Builder $query) {
//            $query->where('user_id','=','');
//        })->get();


        return CashRegister::box();
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
