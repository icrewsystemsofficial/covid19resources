<?php

namespace App\Console\Commands;

use App\Models\User;

use App\Models\Mission;
use App\Models\Twitter;
use Illuminate\Support\Str;
use App\Mail\Mission\Assigned;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MissionAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mission:assign {role=none}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign missions to users';

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

    public static function assignMissions($user, $howmany) {
        $latest = Mission::select('id', 'data', 'volunteer_id')->latest('created_at')->first();
        if($latest) {
            $latest_data = json_decode($latest->data);
            $latest_assigned_tweet = $latest_data[(count($latest_data) - 1)];
            // dd($latest_assigned_tweet);
            //$latest_assigned_tweet = json_decode($latest->data)[99];
        } else {
            $latest_assigned_tweet = '0';
        }



        $tweets = Twitter::select('id')->where('status', Twitter::SCREENED)
                    ->where('id', '>' ,$latest_assigned_tweet)
                    ->orderBy('created_at')
                    ->limit($howmany)
                    ->get();

        if(count($tweets) != '') {
            // dd($tweets);
            $processed_tweets = array();
            $i = 0;
            foreach($tweets as $tweet) {
                $processed_tweets[] = $tweet->id;
                $i++;
            }
            // dd($processed_tweets);
            $processed_tweets = json_encode($processed_tweets);
            $data = array(
                'uuid' => (string) Str::uuid(),
                'description' => 'Your mission objective is to call the phone numbers in the Tweets and verify if the information they have provided accurate & mark them as verified',
                'volunteer_id' => $user->id,
                'slot_start' => $tweets[0]->id,
                'slot_end' => $tweets[(count($tweets) - 1)]->id,
                'data' => $processed_tweets,
                'total' => count($tweets),
            );

            $mission = Mission::create($data);
            return $mission;
        } else {
            return "No tweets left";
        }
    }

    public function handle()
    {
        $this->line('Preparing to assign missions....');

        if($this->argument('role') == 'none') {
            $volunteers = User::where('available_for_mission', 1)->get();
            $this->line('Found '.$volunteers->count().' general users who are ready to be assigned missions...');

        } else if($this->argument('role')) {

            $volunteers = User::role($this->argument('role'))->where('available_for_mission', 1)->get();
            $this->line('Found '.$volunteers->count().' users with role '.$this->argument('role'));

        } else {
            $volunteers = User::hasRoles(['volunteer'])->where('available_for_mission', 1)->get();
            $this->line('Found '.$volunteers->count().' general users who are ready to be assigned missions...');
        }

        $this->line('Peparing screened tweets...');
        $tweets = Twitter::where('status', Twitter::SCREENED)->limit(100)->get();
        $this->line('Found '.$tweets->count().' tweets...');

        $total_tweets = $tweets->count();
        $total_volunteers = $volunteers->count();

        $how_many_tweets_to_assign = round($total_tweets / $total_volunteers);

        if($how_many_tweets_to_assign > config('app.max_tweets_to_assign_in_a_mission')) {
            $how_many_tweets_to_assign = config('app.max_tweets_to_assign_in_a_mission');
        }

        $this->line('Assigning calculated value of '.$how_many_tweets_to_assign.' tweets per user');
        // dd($tweets->count());
        // dd($how_many_tweets_to_assign);

        $mission = array(); //These are mssions that will be created.
        $assigned_tweets = 0;
        foreach($volunteers as $volunteer) {
            $result = self::assignMissions($volunteer, $how_many_tweets_to_assign);
            if(is_object($result)) {
                $mission[] = $result;
                $assigned_tweets = $result->total + $assigned_tweets;
                $this->info('Assigned mission to '.$volunteer->name.', mailing them...');
                Mail::to($volunteer->email)->send(new Assigned($result));
                sleep(5);
            } else {
                continue;
            }
        }


        if($assigned_tweets != 0) {
            $pending_tweets = Twitter::where('status', Twitter::SCREENED)->count();
            $this->info("Assigned ".$assigned_tweets." tweets in ".count($mission)." missions");
            $this->line($pending_tweets.' tweets pending');
        } else {
            if($mission == []) {
                $this->info("All tweets assigned as missions");
            } else {
                $this->info("Success! We were able to assign ".$assigned_tweets." tweets in ".count($mission)." missions");
            }
        }

    }
}
