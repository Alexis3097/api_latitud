<?php

namespace App\Repositories;
use App\IRepositories\IAmountAssignedRepository;
use App\Models\AmountAssigned;

class AmountAssignedRepository implements IAmountAssignedRepository
{
    public function all(){
        return AmountAssigned::paginate(10);
    }
    public function create($data)
    {
        return AmountAssigned::create($data);
    }
    public function show($id){
        return AmountAssigned::find($id);
    }
    public function update($data, $id){
        $amountAssigned = AmountAssigned::find($id);
        $amountAssigned->fill($data);
        return $amountAssigned->save();
    }
    public function delete($id){
        return AmountAssigned::find($id)->delete();
    }
}
