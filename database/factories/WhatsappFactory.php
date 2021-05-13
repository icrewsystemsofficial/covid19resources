<?php

namespace Database\Factories;

use App\Models\Whatsapp;
use Illuminate\Database\Eloquent\Factories\Factory;

class WhatsappFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Whatsapp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(5),
            'body' => $this->faker->sentence(5),
            'location' => 'Near Chennai Airport',
            'state' => 'Tamil Nadu',
            'city' => 'Chennai',
            'wa_phone' => $this->faker->phoneNumber,
            'wa_name' => $this->faker->firstName(),
            'status' => '0',
        ];
    }
}
