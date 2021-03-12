<?php

namespace Database\Seeders;

use App\Values\AbilitiesValues;
use App\Values\RolesValues;
use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Bouncer::role()->create([
            'name' => RolesValues::ADMIN['name'],
            'title' => RolesValues::ADMIN['title']
        ]);

        Bouncer::role()->create([
            'name' => RolesValues::SUPERVISOR['name'],
            'title' => RolesValues::SUPERVISOR['title']
        ]);

        Bouncer::role()->create([
            'name' => RolesValues::CASHIER['name'],
            'title' => RolesValues::CASHIER['title']
        ]);

        Bouncer::allow(RolesValues::ADMIN['name'])->to(AbilitiesValues::ADMINISTRATION_MODULE['name']);
        Bouncer::allow(RolesValues::ADMIN['name'])->to(AbilitiesValues::UPDATE_ROLES['name']);
        Bouncer::allow(RolesValues::ADMIN['name'])->to(AbilitiesValues::PRODUCTS_MODULE['name']);

        Bouncer::allow(RolesValues::SUPERVISOR['name'])->to(AbilitiesValues::UPDATE_ROLES['name']);
        Bouncer::allow(RolesValues::SUPERVISOR['name'])->to(AbilitiesValues::PRODUCTS_MODULE['name']);

        Bouncer::allow(RolesValues::CASHIER['name'])->to(AbilitiesValues::PRODUCTS_MODULE['name']);
    }
}
