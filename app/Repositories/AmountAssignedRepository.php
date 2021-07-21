<?php

namespace App\Repositories;
use App\IRepositories\IAmountAssignedRepository;
use App\Models\AmountAssigned;
use App\Models\Box;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AmountAssignedRepository implements IAmountAssignedRepository
{
    public function all(){
        return AmountAssigned::paginate(10);
    }
    public function create($data)
    {

        DB::beginTransaction();
        try {

            //guardar el monto asignado
            $amount = AmountAssigned::create([
                'user_id'=>$data->user_id,
                'amount'=>$data->amount,
            ]);
            //guardar en el registro de actividades cuanto se le dio - cash_register
            $amount->CashRegister()->create([
                'account'=>$data->amount,
                'type'=>'pagado',
            ]);
            //actualizar si caja del usuario a quien se le envio
            $box = Box::whereHas('user', function (Builder $users) use($data){
                $users->where('user_type_id','=',$data->idDestinatario);
            })->first();
            $box->amount = $box->amount + $data->amount;
            $box->save();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
        }
        return;
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
