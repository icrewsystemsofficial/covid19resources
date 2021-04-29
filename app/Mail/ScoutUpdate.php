<?php

namespace App\Mail;

use App\Models\Twitter;
use App\Models\Resource;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScoutUpdate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tweets = Twitter::count();
        $resources = Resource::count();
        return $this->subject('[Server Update] '.config('app.name').' '.date('H:i A').'')->markdown('email.scout.import', [
            'user' => $this->user,
            'tweets' => $tweets,
            'resources' => $resources,
        ]
        );
    }
}
