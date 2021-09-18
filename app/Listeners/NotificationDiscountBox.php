<?php

namespace App\Listeners;

use App\Events\DiscountBoxEvent;
use App\Models\DeviceGroup;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class NotificationDiscountBox
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DiscountBoxEvent  $event
     * @return void
     */
    public function handle(DiscountBoxEvent $event)
    {
       try{
           //$event->$DiscountBox
           $userTypeAdmin = 1;
           $users = User::where("user_type_id", $userTypeAdmin)->get();
           if($users->count() > 0){
               foreach ($users as $user){
                   $this->sendNotification($user->id);
               }
           }
           Notification::create([
               'user_id'=> $userTypeAdmin,//a quien le pertenece la notificacion
               'type' => 'Caja chica',
           ]);
       }catch (\Exception $e){

       }

    }

    public function sendNotification($user_id){
        try{
            $deviceGroupRegister = DeviceGroup::where('user_id', $user_id)->first();
            if(!is_null($deviceGroupRegister)){
                $response = Http::withHeaders([
                    'Authorization' => env('FCM_KEY')
                ])->acceptJson()->post('https://fcm.googleapis.com/fcm/send',
                    [
                        "notification"=>[
                            "title"=>"Caja chica",
                            "body"=>"caja chica se ha quedado sin fondos"
                        ],
                        "priority"=>"high",
                        "to"=>$deviceGroupRegister->notification_key
                    ]);
            }
        }catch (\Exception $e){

        }
    }
}

