<?php


namespace App\IRepositories;
use App\Contracts\IBaseRepository;

interface ICashRegisterRepository extends IBaseRepository
{
    public function registersXUser($id);
    public function getDetailRegister($id);
    public function getRegistersXUser($id);
    public function getRegisterWithVoucher($id);
}
