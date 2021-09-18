<?php


namespace App\Repositories;
use App\IRepositories\INotificationRepository;
use App\Models\Notification;

class NotificationRepository implements INotificationRepository
{

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getNotificationsXUser($user_id)
    {
        return Notification::where('destination_id',$user_id)->with('user')->orderBy('id','desc')->paginate(10);
    }
}
