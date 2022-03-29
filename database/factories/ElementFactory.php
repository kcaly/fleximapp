<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ElementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName,
            'length' => '1000',
            'width' => '500',
            'height' => '100',
            'weight' => (((1000*0.001)*(500*0.001)*(100*0.001))*35),
            'machine' => 'OFS-HE3',
            'material_id' => '1',

        ];
    }
}
