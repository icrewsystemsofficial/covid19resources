<?php

namespace App\Console\Commands;

use App\Models\Referral;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
class CreateReferralLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:reflinks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to create Referral links for the users';

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
        $users = User::all();

        foreach ($users as $user) {
            $kebab = Str::kebab($user->name);
            $referral = new Referral;
            $referral->user_id = $user->id;
            $referral->referral_link = $kebab;
            $referral->referrer_ip = "192.168.0.138";
            $referral->save();
        }
        $this->info('refrreal links created ');

        // $referral->referral_link =
    }
}
