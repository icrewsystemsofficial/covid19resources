<?php

namespace App\Console\Commands;

use App\Models\Mission;
use App\Jobs\Missions\Reminder;
use Illuminate\Console\Command;

class RemindVolunteersAboutMission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mission:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind volunteers about their assigned missions & their completions';

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
        $missions = Mission::where('status', '!=', Mission::COMPLETED)->groupBy('volunteer_id')->get();
        foreach($missions as $mission) {
            // $this->line($mission->getVolunteer->name);
            $assignedMissions = Mission::where('volunteer_id', $mission->volunteer_id)->get();

            $this->info($assignedMissions->count().' missions assigned to '.$mission->getVolunteer->name);

            $total = 0;
            $completed = 0;

            Reminder::dispatch($mission->getVolunteer, $assignedMissions);

            foreach($assignedMissions as $assignedMission) {
                $total = $total + $assignedMission->total;
                $completed = $completed + $assignedMission->completed;
                $this->line('Mission # '.$assignedMission->id.': '.$assignedMission->getStatus()->name.' - '.$completed.'/'.$total);
            }

        }
    }
}
