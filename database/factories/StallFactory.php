<?php

namespace Database\Factories;

use App\Models\Stall;
use Illuminate\Database\Eloquent\Factories\Factory;

class StallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stall::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'name'        => $this->faker->title,
            'lat'         => $this->faker->latitude,
            'lon'         => $this->faker->longitude,
            'town'        => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'street'      => $this->faker->streetName,
            'place_name'  => $this->faker->name,
            'open'        => $this->faker->dateTime,
            'close'       => $this->faker->dateTime,
            'user_id'     => 1,
            'owner'       => 'Jam Owner',
        ];
    }
}
