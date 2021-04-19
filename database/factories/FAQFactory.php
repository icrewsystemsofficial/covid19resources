<?php

namespace Database\Factories;

use App\Models\FAQ;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FAQFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FAQ::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(10),
            'state' => 'Tamil Nadu',
            'district' => 'Chennai',
            'status' => $this->faker->boolean(90),
            'categories' => json_encode(['1', '2', '3']),
            'author_id' => User::first(),
        ];
    }
}
