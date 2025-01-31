<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define os comandos do aplicativo.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Define o agendamento de tarefas.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new \App\Jobs\SyncDataFromAPI)->daily();
    }
}