<?php

namespace App\Mail;

use App\Http\Controllers\API\Twitter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TweetStats extends Mailable
{
    use Queueable, SerializesModels;

    public $tweet_stats = (new Twitter)->getstats();

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.tweetStats')
            ->from('admin@icrew.com')
            ->subject('Twitter Stats from our Dashboard')
            ->with(['redirect_url' => route('home')]);
    }
}
