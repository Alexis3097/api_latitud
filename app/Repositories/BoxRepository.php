<?php


namespace App\Repositories;
use  App\IRepositories\IBoxRepository;
use App\Models\Box;
use Illuminate\Database\Eloquent\Builder;
class BoxRepository implements IBoxRepository
{

    public function all()
    {
        // TODO: Implement all() method.
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

    function getCajaChica()
    {
     return Box::whereHas('user',function (Builder $query){
         //3 es de caja chica
         $query->where('user_type_id','=',3);
     })->get();
    }

    public function approveExpense($idUser,$amount)
    {
        if(!is_null($amount)){
            $box =  Box::where('user_id', $idUser)->first();
            $box->amount -=$amount;
            $box->save();
            return $box;
        }
        return null;

    }

}
