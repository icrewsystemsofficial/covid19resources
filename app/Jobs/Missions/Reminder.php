<?php

namespace App\Jobs\Missions;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\Mission\Reminder as MissionReminder;

class Reminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $missions;
    public $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $missions)
    {
        $this->user = $user;
        $this->missions = $missions;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new MissionReminder($this->user, $this->missions));
    }
}
