<?php
namespace App\IRepositories;

interface INotificationTokenRepository
{
    /**
     * guarda el token de un usuario
     * @param integer $user_id de quien es el token
     * @param String $token token a gurdar relacionado con el usuario
     */
    public function saveUserToken($user_id,$token);
}
