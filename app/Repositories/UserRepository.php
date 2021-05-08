<?php

namespace App\Repositories;
use App\Models\User;
use App\IRepositories\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    /**
     * @throws \Throwable
     */
    public function create($data): bool
    {
        $data['password'] = $this->hashPassword($data->password);
        return User::saveOrFail($data);
    }
    public function show($id){

    }
    public function update($data, $id){

    }
    public function delete($id){

    }

    public function hashPassword($password): string
    {
        return Hash::make($password);
    }

    public function all(){

    }
}
