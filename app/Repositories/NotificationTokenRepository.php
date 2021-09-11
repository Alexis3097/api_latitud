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
        $userToken = new NotificationToken();
        $userToken->user_id =$user_id;
        $userToken->token = $token;
         return  $userToken->saveOrFail();
    }
}
