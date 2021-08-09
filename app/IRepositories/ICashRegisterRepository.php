<?php


namespace App\IRepositories;
use App\Contracts\IBaseRepository;

interface ICashRegisterRepository extends IBaseRepository
{
public function registersCajaChia();
    public function getDetailRegister($id);
}
