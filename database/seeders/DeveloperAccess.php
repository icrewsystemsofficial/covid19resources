<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DeveloperAccess extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $this->command->line('Seeding Users from DeveloperAccess file...');
        $user = User::where('name', 'Leonard Selvaraja')->first();
        if (!$user) {
            //If you need to add an account for yourself, add it below this.
            $user = new User;
            $user->name = 'Leonard Selvaraja';
            $user->email = 'kashrayks@gmail.com';
            $user->email_verified_at = now();
            $user->password = "$2y$10$8CfoYn2vturcIeuGRQfzfuUb1XOT2G3aSvZZBiISMbz80hxfAHM7."; //You can use bcrypt() method to encrypt your password. Eg: bcrypt('mypassword');
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Leonard Selvaraja created.");
        }

        $user = User::where('name', 'Thirumalai')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Thirumalai';
            $user->email = 'm.thirurahul@gmail.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$gp5aizeQoP2mLDCPj.utb.xXS1rQaM3PkXd.Z1XliBWTxQcdXqqUC'; //You can use bcrypt() method to encrypt your password. Eg: bcrypt('mypassword');
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Thirumalai created.");
        }

        $user = User::where('name', 'Dinesh Kumar')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Dinesh Kumar';
            $user->email = 'john.doe@test.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$RufvOqmxVVsmvWA0w9P2DuMhbfxLt8lQQrxZNCB1nu7NtpJDj1jvi'; //You can use bcrypt() method to encrypt your password. Eg: bcrypt('mypassword');
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Dinesh Kumar created.");
        }


        $user = User::where('name', 'Ayshwaria Grace')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Ayshwaria Grace';
            $user->email = 'ayshwaria.grace@icrewsystems.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$.UuTdJSIjY.ztfspGgaJ8.FyA7VjsC8TKZ3jxoWaoeQi7rIZYY6xO';
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Ayshwaria Grace created.");
        }

        $user = User::where('name', 'Dhruv Bhatt')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Dhruv Bhatt';
            $user->email = 'dhruvpbhatt2902@gmail.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$.UuTdJSIjY.ztfspGgaJ8.FyA7VjsC8TKZ3jxoWaoeQi7rIZYY6xO';
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Dhruv Bhatt created.");
        }

        $user = User::where('name', 'Aara Amuthan')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Aara Amuthan';
            $user->email = 'aaraamuthanb@gmail.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$sk3M5Z8MKDsouFdG9UnYhea.W5tONqLLDGDFe2MNlj3RoRqi0/wpu';
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Aara Amuthan created.");
        }

        $user = User::where('name', 'Samay Bhattacharyya')->first();
        if (!$user) {
            //If you need to add an account for yourself, add it below this.
            $user = new User;
            $user->name = 'Samay Bhattacharyya';
            $user->email = 'lyrakerman@gmail.com';
            $user->email_verified_at = now();
            $user->password = '$2y$10$Z2fX/TDd7hIjBnamBhW9/eiffpxiVddzY/Kyihap2A074PXHMb2jG'; //You can use bcrypt() method to encrypt your password. Eg: bcrypt('mypassword');
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: Samay Bhattacharyya created.");
        }
        $user = User::where('name', 'vibularoslin')->first();
        if (!$user) {
            //If you need to add an account for yourself, add it below this.
            $user = new User;
            $user->name = 'vibularoslin';
            $user->email = 'test@gmail.com';
            $user->email_verified_at = now();
            $user->password =  bcrypt('test1234'); 
            $user->accepted = '1';
            $user->save();
            $this->command->info("User: vibularoslin created.");
        }
    }
}
