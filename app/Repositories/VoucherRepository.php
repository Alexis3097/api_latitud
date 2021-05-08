<?php

namespace App\Repositories;
use App\Models\Voucher;
use App\IRepositories\IVoucherRepository;

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
