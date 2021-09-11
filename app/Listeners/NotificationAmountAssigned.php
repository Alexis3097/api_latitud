<?php

namespace App\Listeners;

use App\Events\AmountAssignedEvent;
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

        $response = Http::withHeaders([
            'Authorization' => env('FCM_KEY')
        ])->acceptJson()->post('https://fcm.googleapis.com/fcm/send',
            [
                "notification"=>[
                    "title"=>"evento",
                    "body"=>"sub sub evento"
                ],
                "priority"=>"high",
                "to"=>"f-hGcoWARG6tReEPnasWh8:APA91bHRMrogYmdoeoEPiBqzTK-aLQeTQaVEFmZT6BOBMngM-r2-ZSF2-9ytKPneU0LxGfNWYHJbJCNyLrhuH1_WPuRqEr1BhxBWWC57C_EWB9QTeqfb_x5PpzbPczGaBE8CPb2rkYlx"
            ]);

    }
}
