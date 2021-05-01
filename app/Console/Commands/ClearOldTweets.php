<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Twitter;
use App\Mail\MarkOldTweets;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ClearOldTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:clear-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark all the tweets older than a week as "OLD" (ID # 7)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Deleting tweets that are older than a week');

        // $this->line(Carbon::now()->subDays(7)->format('d/m/Y'));


        $oneWeek = Carbon::now()->toDateTimeString();
        // $oneWeek = Carbon::now()->subDays(7)->toDateTimeString();

        $tweets = Twitter::where('status', Twitter::SCREENED)
                    ->whereDate('created_at', '>', $oneWeek)->orderBy('created_at', 'DESC')->get();

        if($tweets->count() > 0) {
        	$this->line('Found '.$tweets->count().' old tweets...marking them as OLD');
	        $i = 0;
	        foreach($tweets as $tweet) {

                $tweet->status = Twitter::OLD;
                $tweet->save();
	            $i++;
	            $this->line('Marked Tweet # '.$tweet->created_at->format('d/m/Y'));
	        }

            $this->info('Marked: '.$i.' tweets as OLD, email superadmins..');
            $users = User::role('superadmin')->get();
            foreach($users as $user) {
                $this->line('Sending email to '.$user->name);
                $data = array(
                    'user' => $user->name,
                    'total' => $i,
                    'date' => Carbon::now()->format('d/m/Y'),
                );

                Mail::to($user->email)->send(new MarkOldTweets($data));
            }


        } else {
        	$this->info('Yay! No old tweets found');
        }
    }
}
