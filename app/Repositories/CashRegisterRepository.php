<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
use App\Models\CashRegister;

class CashRegisterRepository implements ICashRegisterRepository
{

    public function all()
    {
        return CashRegister::with('box');
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
