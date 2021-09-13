<?php

namespace App\Listeners;

use App\Events\AmountAssignedEvent;
use App\Models\DeviceGroup;
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
        // Access the order using $event->AmountAssigned...
        $deviceGroupRegister = DeviceGroup::where('user_id', $event->AmountAssigned)->first();
        $response = Http::withHeaders([
            'Authorization' => env('FCM_KEY')
        ])->acceptJson()->post('https://fcm.googleapis.com/fcm/send',
            [
                "notification"=>[
                    "title"=>"evento",
                    "body"=>"sub sub evento"
                ],
                "priority"=>"high",
                "to"=>$deviceGroupRegister->notification_key
            ]);

    }
}
