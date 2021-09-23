<?php

namespace App\Console;

use App\Models\Voucher;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        $schedule->call(function () {
            $vouchers = Voucher::where('approve',true)->where('photoId','!=',null)->get();
            if($vouchers->count() > 0){
                foreach ($vouchers as $voucher){
                    if($voucher->created_at->diffInDays() > 7){
                        //eliminar la foto
                        cloudinary()->destroy($voucher->photoId);
                    }
                }

            }
        })->dailyAt('00:00');
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
}
