<?php


namespace App\Repositories;


use App\IRepositories\ICashRegisterRepository;
use App\Models\AmountAssigned;
use App\Models\CashRegister;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;

class CashRegisterRepository implements ICashRegisterRepository
{

    public function all()
    {
        return CashRegister::orderBy('id','desc')->paginate(10);
    }
    public function registersCajaChia()
    {
//        $cashRegister = CashRegister::whereHasMorph('registrable', function (Builder $query) {
//            $query->whereHas('user', function (Builder $users){
//                //3 es el tipo de usuario caja chica y 1 es admin
//                $users->where('user_type_id','=',3)->orWhere('user_type_id','=','1');
//            });
//        })->orderBy('id','desc')->paginate(10);

        $cashRegister = CashRegister::whereHasMorph(
            'registrable',
            [AmountAssigned::class, Voucher::class],
            function (Builder $query) {
                $query->where('type', 'like', 'adeudo%');
            }
        )->get();

//        $cashRegister = CashRegister::all();
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
