<?php

namespace App\IRepositories;
use App\Contracts\IBaseRepository;

interface IVoucherRepository extends IBaseRepository
{
    public function getExpenseType();
    public function  getCheckType();

}
