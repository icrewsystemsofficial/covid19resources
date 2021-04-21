<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Districts;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Seeding Cities from JSON file');
        // $json = file_get_contents('https://raw.githubusercontent.com/fayazara/Indian-Cities-API/master/cities.json');
        $json = File::get('database/json/cities.json');
        $data = json_decode($json);
        foreach($data as $obj) {
            foreach($obj as $city) {

                $district_find = Districts::where('name', $city->District)->first();
                if(!$district_find) {
                    $db_district = new Districts;
                    $db_district->name = $city->District;
                    $db_district->code = 'null';
                    $db_district->state = $city->State;
                    $db_district->created_at = now()->toDateTimeString();
                    $db_district->updated_at = now()->toDateTimeString();
                    $db_district->save();
                    $this->command->info($city->District.' [DISTRICT] was added');
                }

                $city_find = City::where('name', $city->City)->first();
                if(!$city_find) {
                    $db_city = new City;
                    $db_city->name = $city->City;
                    $db_city->district = $city->District;
                    $db_city->state = $city->State;
                    $db_city->created_at = now()->toDateTimeString();
                    $db_city->updated_at = now()->toDateTimeString();
                    $db_city->save();
                    $this->command->info($city->City.', ['.$city->District.', '.$city->State.'] was added');
                } else {
                    $this->command->error($city->City.', ['.$city->District.', '.$city->State.'] already exists');
                }
            }
        }
    }
}
