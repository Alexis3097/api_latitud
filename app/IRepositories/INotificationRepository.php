<?php


namespace App\IRepositories;
use  App\Contracts\IBaseRepository;

interface INotificationRepository extends IBaseRepository
{
    public function getNotificationsXUser($user_id);
    public function markNotification($id);
}
