<?php

namespace Database\Factories;

use App\Models\Icecream;
use Illuminate\Database\Eloquent\Factories\Factory;

class IcecreamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Icecream::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'flavour'    => $this->faker->name,
            'type'       => $this->faker->name,
            'form'       => $this->faker->name,
            'price'      => 12.37,
            'quantity'   => $this->faker->randomDigit,
            'stall_id'   => 1,
            'user_id'    => 1


            //
        ];
    }
}
