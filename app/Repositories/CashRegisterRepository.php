<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
use App\Models\CashRegister;
use Illuminate\Database\Eloquent\Builder;

class CashRegisterRepository implements ICashRegisterRepository
{

    public function all()
    {
        $page = 2;
        return CashRegister::paginate(5)->appends( ['page' => $page]);
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
