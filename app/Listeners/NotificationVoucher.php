<?php

namespace App\Listeners;

use App\Events\VoucherEvent;
use App\Models\DeviceGroup;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class NotificationVoucher
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
     * @param  VoucherEvent  $event
     * @return void
     */
    public function handle(VoucherEvent $event)
    {
       try{
           // Access the order using $event->voucherObject...
           $deviceGroupRegister = DeviceGroup::where('user_id', $event->voucherObject["idDestinatario"])->first();
           if(!is_null($deviceGroupRegister)){
               $response = Http::withHeaders([
                   'Authorization' => env('FCM_KEY')
               ])->acceptJson()->post('https://fcm.googleapis.com/fcm/send',
                   [
                       "notification"=>[
                           "title"=>"Comprobante de pago",
                           "body"=>$event->voucherObject["remitente"]." ha comprobado gastos"
                       ],
                       "priority"=>"high",
                       "to"=>$deviceGroupRegister->notification_key
                   ]);
           }
           Notification::create([
               'user_id'=> $event->voucherObject["idDestinatario"],//a quien le pertenece la notificacion
               'type' => 'Voucher',
               'register_id'=>$event->voucherObject["register_id"],
           ]);
       }catch (\Exception $e){

       }
    }
}
