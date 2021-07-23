<?php


namespace App\Repositories;
use App\IRepositories\IUserTypeRepository;
use App\Models\UserType;

class UserTypeRepository implements IUserTypeRepository
{

    public function all()
    {
        return UserType::all();
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
