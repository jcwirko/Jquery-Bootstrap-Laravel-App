<?php

namespace Database\Seeders;

use App\Models\User;
use App\Values\AbilitiesValues;
use App\Values\RolesValues;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Elon Musk',
            'birthdate' => '1960-10-10',
            'email' => 'return@gmail.com',
            'password' => Hash::make('secret')
        ]);

        $admin->assign(RolesValues::ADMIN['name']);
    }
}