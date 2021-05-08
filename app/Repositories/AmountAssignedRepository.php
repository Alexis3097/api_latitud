<?php

namespace App\Repositories;
use App\Models\AmountAssigned;
use App\IRepositories\IAmountAssignedRepository;

class AmountAssignedRepository implements IAmountAssignedRepository
{
    public function create($data): bool
    {
        return AmountAssigned::saveOrFail($data);
    }
    public function show($id){

    }
    public function update($data, $id){

    }
    public function delete($id){

    }
    public function all(){
        return AmountAssigned::all();
    }
}
