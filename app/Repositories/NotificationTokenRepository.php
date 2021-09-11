<?php


namespace App\Repositories;
use App\IRepositories\INotificationTokenRepository;
use App\Models\NotificationToken;
class NotificationTokenRepository implements INotificationTokenRepository
{

    /**
     * @inheritDoc
     */
    public function saveUserToken($idUser, $token)
    {
         return  NotificationToken::firstOrCreate(
            ['user_id' => $idUser],
            ['token' => $token]
        );
    }
}
