<?php

namespace App\Listeners;

use App\Events\AmountAssignedEvent;
use App\Models\DeviceGroup;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
class NotificationAmountAssigned
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
     * @param  AmountAssignedEvent  $event
     * @return void
     */
    public function handle(AmountAssignedEvent $event)
    {
        try{
            // Access the order using $event->AmountAssigned...
            $deviceGroupRegister = DeviceGroup::where('user_id', $event->AmountAssigned["idDestinatario"])->first();
            if(!is_null($deviceGroupRegister)){
                $response = Http::withHeaders([
                    'Authorization' => env('FCM_KEY')
                ])->acceptJson()->post('https://fcm.googleapis.com/fcm/send',
                    [
                        "notification"=>[
                            "title"=>"Depósito",
                            "body"=>$event->AmountAssigned["remitente"]." te ha depositado"
                        ],
                        "priority"=>"high",
                        "to"=>$deviceGroupRegister->notification_key
                    ]);
            }
            Notification::create([
                'user_id'=> $event->AmountAssigned["idDestinatario"],
                'type' => 'AmountAssigned',
                'register_id'=>$event->AmountAssigned["register_id"],
            ]);
        }catch (\Exception $e){

        }
    }
}
