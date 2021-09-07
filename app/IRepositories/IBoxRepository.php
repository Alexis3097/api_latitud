<?php


namespace App\IRepositories;
use  App\Contracts\IBaseRepository;

interface IBoxRepository extends IBaseRepository
{
 function getCajaChica();
 public function approveExpense($idUser, $amount);

/**
 * resta una cantidad a la caja de un usuario
 *
 * @return object un null si no se guardo y un modelo si, se guardo
 * @param integer $idUser usuario de la caja chica
 * @param double $amount cantidad a disminuir
 */
 public function discountBox($idUser, $amount);
}
