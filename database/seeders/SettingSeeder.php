<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
            array('id' => '3','name' => 'BLACKLISTED_KEYWORDS','description' => 'Blaclisted keywords for the TwitterScanner','value' => 'bjp, modi, government, disaster, fuck, hell, angry, kumbh, pakistan, worst, disappointed','core' => '1','created_at' => '2021-04-26 20:09:11','updated_at' => '2021-04-26 23:30:02'),
            array('id' => '4','name' => 'APP_NAME','description' => 'This is the application name.','value' => 'COVID19 Verified Resources','core' => '1','created_at' => '2021-04-26 22:30:22','updated_at' => '2021-04-26 22:35:09'),
            array('id' => '5','name' => 'MAX_TWEETS_TO_ASSIGN_IN_A_MISSION','description' => 'The maximum number of tweets to assign for a user in a mission.','value' => '50','core' => '1','created_at' => '2021-04-26 23:14:26','updated_at' => '2021-04-26 23:14:26')
          );

          foreach($settings as $request) {

            $request = (object) $request;

            $setting = new Setting;
            $setting->name = $request->name;
            $setting->description = $request->description;
            $setting->value = $request->value;
            $setting->core = $request->core;
            $setting->save();
          }
    }
}
