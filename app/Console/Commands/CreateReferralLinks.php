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
    protected $description = 'Command to generate referral signup links';

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
        $users = User::where('referral_link', null)->get();
        if(count($users) == 0) {
            return $this->info('Good job! All users already have referral links');
        }

        foreach ($users as $user) {
            $kebab = Str::kebab($user->name);
            $randnum = rand(pow(10, 5-1), pow(10, 5)-1);
            $reflink = $kebab.'-'.$randnum;
            $user->referral_link = $reflink;
            $user->save();
            $this->line('Created ' . $user->referral_link);
        }

        return $this->info('Manually created links for '.count($users).' users');

        // $referral->referral_link =
    }
}
