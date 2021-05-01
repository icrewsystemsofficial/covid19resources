<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarkOldTweets extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->data['user'];
        $date = $this->data['date'];
        $total = $this->data['total'];

        return $this
        ->subject('[Server Update] '.config('app.name').' | '.$total.' tweets marked as OLD')
        ->markdown('email.tweets.markedoldtweets', [
            'user' => $user,
            'date' => $date,
            'total' => $total,
        ]);
    }
}
