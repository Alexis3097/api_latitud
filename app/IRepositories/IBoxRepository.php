<?php


namespace App\IRepositories;
use  App\Contracts\IBaseRepository;

interface IBoxRepository extends IBaseRepository
{
 function getCajaChica();
 public function approveExpense($idUser);
}
