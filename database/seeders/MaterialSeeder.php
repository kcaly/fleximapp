<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Material::factory(1)->create();
    }
}
