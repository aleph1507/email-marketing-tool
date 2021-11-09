<?php

namespace App\Console;

use App\Models\Campaign;
use App\Services\MailService;
use Carbon\Carbon;
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

    private $mailService;

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () use ($schedule) {
            $campaigns = Campaign::future()->unscheduled()->unsent()->get();
            foreach ($campaigns as $campaign) {
                $dt = Carbon::create($campaign->send_at);
                $cronParam = implode(' ', [$dt->minute, $dt->hour, $dt->day, $dt->month, $dt->year]);
                $schedule->call(function () use ($campaign) {
                    MailService::mailCampaign($campaign);
                })->cron($cronParam);
                $campaign->update(['scheduled' => true]);
                echo "cronParam: $cronParam";
            }
        })->everyMinute();
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
