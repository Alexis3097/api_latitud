<?php

namespace App\Repositories;
use App\Models\Voucher;
use App\IRepositories\IVoucherRepository;

class VoucherRepository implements IVoucherRepository
{

    public function all(){
        return Voucher::paginate(10);
    }
    public function create($data)
    {
        return Voucher::create($data);
    }
    public function show($id){
        return Voucher::find($id);
    }
    public function update($data, $id){
        $voucher = Voucher::find($id);
        $voucher->fill($data);
        return $voucher->save();
    }
    public function delete($id){
        return Voucher::find($id)->delete();
    }
}
