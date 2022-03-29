<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 't-35 180',
            'length' => 2400,
            'width' => 2000,
            'height'=> 1200,
            'value' => 35,
            'price' => 10.45
            
            
        ];
    }
}
