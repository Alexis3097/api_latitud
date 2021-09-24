<?php

namespace App\Console;

use App\Models\DeviceGroup;
use App\Models\Notification;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];


    protected function scheduleTimezone()
    {
        return 'America/Mexico_City';
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //elimina las fotos del servidor cuando ya estan aprobados
        $schedule->call(function () {
            $vouchers = Voucher::where('approve',true)->where('photoId','!=',null)->get();
            if($vouchers->count() > 0){
                foreach ($vouchers as $voucher){
                    if($voucher->created_at->diffInDays() > 7){
                        //eliminar la foto
                        cloudinary()->destroy($voucher->photoId);
                        //actualiza la base de datos del registro que se elimino la foto
                        $voucher->photo = null;
                        $voucher->photoId = null;
                        $voucher->save();
                    }
                }

            }
        })->dailyAt('00:00');

        //notificaccion el ultimo dia del mes
        // el 1 es el userType adminn
        $schedule->call(function () {
            $users = User::where("user_type_id", "!=", 1)->get();
            if($users->count() > 0){
                foreach ($users as $user){
                    $this->sendNotification($user->id);
                }
            }
        })->monthlyOn(27, '11:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
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
                            "title"=>"Recordatorio",
                            "body"=>"Realiza tus comprobantes de pago antes del fin de mes"
                        ],
                        "priority"=>"high",
                        "to"=>$deviceGroupRegister->notification_key
                    ]);
                //el 1 es el id del admin
                Notification::create([
                    'user_id'=> 1,//a quien hizo la notificacion
                    'destination_id'=> $user_id,//quien le pertenece la notificacion
                    'type' => 'Recordatorio',
                    'register_id'=>0,//es cero cuando no es registro, solo aviso
                ]);
            }
        }catch (\Exception $e){

        }
    }
}
