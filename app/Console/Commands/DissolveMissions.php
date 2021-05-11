<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Mission;
use App\Mail\Mission\Dissolved;
use App\Mail\Mission\DissolvedStats;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DissolveMissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mission:dissolve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dissolve missions which are assigned, and are older than 3 days';

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
        $missions = Mission::where('status', Mission::ASSIGNED)->whereDate('created_at', '<', Carbon::yesterday())->get();

        if($missions->count() > 0) {

            $cleared = 0;
            $defaulters = array();
            foreach($missions as $mission) {
                $this->line('Dissolving mission #' . $mission->id .', assigned to ' . $mission->getVolunteer->name . ' at ' . $mission->created_at->format('d/m/Y'));
                $cleared++;

                $user = User::find($mission->getVolunteer->id);
                if($user->points > 50) {
                    $user->points = $user->points - 50;
                    $user->update();
                }

                $data = array(
                    'name' => $mission->getVolunteer->name,
                    'mission' => $mission,
                    'points' => $user->points,
                );

                $defaulters[] = $mission->getVolunteer->name .' - Mission '.$mission->id;
                Mail::to($mission->getVolunteer->email)->send(new Dissolved($data));

                $mission->delete();
            }



            $users = User::role('superadmin')->get();
            foreach($users as $user) {
                $this->info('Mailing '.$user->name);

                $stats = array(
                    'name' => $user->name,
                    'total' => $cleared,
                    'defaulters' => $defaulters,
                );

                Mail::to($user->email)->send(new DissolvedStats($stats));
            }

            $this->info('Dissolved '.$cleared.' missions');
        } else {
            $this->info('Yay! No old missions found');
        }
    }
}
