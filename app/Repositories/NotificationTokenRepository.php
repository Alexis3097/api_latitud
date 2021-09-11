<?php


namespace App\Repositories;
use App\IRepositories\INotificationTokenRepository;
use App\Models\NotificationToken;
class NotificationTokenRepository implements INotificationTokenRepository
{

    /**
     * @inheritDoc
     */
    public function saveUserToken($user_id, $token)
    {
         return  NotificationToken::saveOrFail([
             'user_id'=>$user_id,
             'token'=>$token
         ]);
    }
}
