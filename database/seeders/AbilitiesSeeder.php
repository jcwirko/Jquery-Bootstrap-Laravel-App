<?php

namespace Database\Seeders;

use App\Values\AbilitiesValues;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class AbilitiesSeeder extends Seeder
{
    public function run()
    {
        Bouncer::ability()->create([
            'name' => AbilitiesValues::ADMINISTRATION_MODULE['name'],
            'title' =>AbilitiesValues::ADMINISTRATION_MODULE['title'],
        ]);

        Bouncer::ability()->create([
            'name' => AbilitiesValues::UPDATE_ROLES['name'],
            'title' =>AbilitiesValues::UPDATE_ROLES['title'],
        ]);

        Bouncer::ability()->create([
            'name' => AbilitiesValues::PRODUCTS_MODULE['name'],
            'title' =>AbilitiesValues::PRODUCTS_MODULE['title'],
        ]);
    }
}
