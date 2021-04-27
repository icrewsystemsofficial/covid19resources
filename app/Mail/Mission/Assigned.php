<?php

namespace App\Mail\Mission;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Assigned extends Mailable
{
    use Queueable, SerializesModels;
    public $mission;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mission)
    {
        $this->mission = $mission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::find($this->mission->volunteer_id);
        return $this->subject('[IMPORTANT] '.config('app.name').' | Mission #'.$this->mission->id.' assigned')->markdown('email.mission.assigned', [
            'mission' => $this->mission,
            'user' => $user,
        ]);
    }
}
