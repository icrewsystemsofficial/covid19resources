<?php

namespace App\Mail\Mission;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $missions;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $missions)
    {
        $this->user = $user;
        $this->missions = $missions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('[WARNING] '.config('app.name').' | '.count($this->missions).' pending missions')
            ->markdown('email.mission.reminder');
    }
}
