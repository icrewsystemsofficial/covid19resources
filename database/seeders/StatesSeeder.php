<?php

namespace Database\Seeders;

use App\Models\Districts;
use App\Models\States;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Seeding States from JSON file');
        $json = File::get('database/json/states.json');
        // $json = file_get_contents('https://gist.githubusercontent.com/Dhaneshmonds/1b0ca257b1c34e4842528dcb826ee880/raw/bf0632f3b2a613ac5cb80b9f1dfcf7ff16b7c373/IndianStatesDistricts.json');
        $data = json_decode($json);
        foreach($data as $obj) {
            foreach($obj as $state) {
                $state_find = States::where('code', $state->code)->first();
                if(!$state_find) {
                    $db_state = new States;
                    $db_state->name = $state->name;
                    $db_state->code = $state->code;
                    $db_state->capital = $state->capital;
                    $db_state->districts = count($state->districts);
                    $db_state->type = strtolower(str_replace(' ', '-', $state->type));
                    $db_state->created_at = now()->toDateTimeString();
                    $db_state->updated_at = now()->toDateTimeString();
                    $db_state->save();
                    $this->command->info($state->name.' ['.$state->type.'] was added');
                } else {
                    $this->command->error($state->name.' - ['.$state->type.'] already exists in the DB');
                }

                if(count($state->districts) > 0) {
                    $this->command->info(' == ' . count($state->districts).' districts found for '.$state->name .' == ');
                    foreach($state->districts as $district) {
                        $district_find = Districts::where('name', $district->name)->first();
                        if(!$district_find > 0) {
                            $db_district = new Districts;
                            $db_district->name = $district->name;
                            $db_district->code = $state->code;
                            $db_district->state = $state->name;
                            $db_district->created_at = now()->toDateTimeString();
                            $db_district->updated_at = now()->toDateTimeString();
                            $db_district->save();
                            $this->command->info($district->name.' [DISTRICT] was added');
                        } else {
                            $this->command->error($district->name.' [DISTRICT] already exists in the DB');
                        }
                    }
                }
            }
        }

        $this->command->line('States were successfully seeded.');
    }
}
