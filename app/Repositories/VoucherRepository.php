<?php

namespace App\Repository;
use App\Models\Voucher;
use App\IRepository\IVoucherRepository;

class VoucherRepository implements IVoucherRepository
{
    /**
     * @throws \Throwable
     */
    public function create($data): bool
    {
        return Voucher::saveOrFail($data);
    }
    public function show($id){

    }
    public function update($data, $id){

    }
    public function delete($id){

    }
    public function all(){
        return Voucher::all();
    }
}
