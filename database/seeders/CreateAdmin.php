<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Karol Cały',
            'nip' => '7393925559',
            'contact' => '+48 888 8884 710',
            'address' => 'Rataja 19A/1',
            'postcode' => '10-202',
            'city' => 'Olsztyn',
            'flexim_id' => 'X01',
       ]);

        User::create([
            'tag_user' => 'Admin',
            'first_name' => 'Karol',
            'last_name' => 'Karol',
            'role_id' => '1',
            'email' => 'admin@fleximapp.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // password
            'remember_token' => Str::random(10),
            'company_id' => '1',
       ]);
    }
}
