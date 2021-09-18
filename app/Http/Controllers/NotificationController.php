<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\Http\Resources\NotificationResource;
use App\IRepositories\INotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
class NotificationController extends Controller
{
    protected $INotificationRepository;
    function __construct(INotificationRepository $INotificationRepository){
        $this->middleware('auth:api');
        $this->INotificationRepository = $INotificationRepository;
    }

    public function getNotificationsXUser($user_id)
    {
        try{

            $notifications = $this->INotificationRepository->getNotificationsXUser($user_id);
            if(!is_null($notifications)){
                return NotificationResource::collection($notifications);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }
}
