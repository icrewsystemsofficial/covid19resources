<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $statuses = array(0, 1, 2);
        $verified = array_rand($statuses);

        $hasAddress = $this->faker->boolean(90);
        if($hasAddress == 1) {
            $location = City::inRandomOrder()->first();
            $city = $location->name;
            $district = $location->district;
            $state = $location->state;
            $landmark = $this->faker->word(1);
            // $coords = Http::get('https://www.gps-coordinates.net/api/'.$location->state);
            // withHeaders([
            //     'X-First' => 'foo',
            //     'X-Second' => 'bar'
            // ])->
            // $data = $coords->json();
            // $data = (object) $data;
            // print_r($data);
            // if($data->responseCode == 200) {
            //     $coordinates = $data->latitude.','.$data->longitude;
            // } else {
            //     // $coordinates = $this->faker->latitude().','.$this->faker->longitude();
            //     $coordinates = '13, 80';
            // }

            $coordinates = '13, 80';

        } else {
            $city = null;
            $district = null;
            $state = null;
            $landmark = null;
            $coordinates = null;
        }


        $categories = Category::where('status', 1)->inRandomOrder()->first();
        return [
            //
            'category' => $categories->id,
            'title' => $this->faker->catchPhrase(),
            'body' => $this->faker->sentence(4),
            'phone' => $this->faker->e164PhoneNumber,
            'url' => $this->faker->url,
            'author_id' => User::inRandomOrder()->first(),
            'verified' => $verified,
            'verified_by' => User::inRandomOrder()->first(),
            'hasAddress' => $hasAddress,
            'city' => $city,
            'district' => $district,
            'state' => $state,
            'landmark' => $landmark,
            'coordinates' => $coordinates,
        ];
    }
}
