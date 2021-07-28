<?php

namespace App\IRepositories;

use App\Contracts\IBaseRepository;

interface IUserRepository extends IBaseRepository
{
    public function  getCoordinadores();
    public function  onlyUsers();
}
