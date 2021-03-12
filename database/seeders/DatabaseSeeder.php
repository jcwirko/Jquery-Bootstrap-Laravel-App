<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AbilitiesSeeder::class,
            RolesSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
