<?php

namespace App\Repositories;

use Silber\Bouncer\BouncerFacade as Bouncer;

class RoleRepository
{
    public function store(string $name, string $title = null)
    {
        return Bouncer::role()->create([
            'name' => $name,
            'title' => $title
        ]);
    }

    public function update(string $actualRole, string $newRole, string $newTitle = null)
    {
        Bouncer::role()
            ->where('name', $actualRole)
            ->update([
                'name' => $newRole,
                'title' => $newTitle
            ]);
    }

    public function destroy($role)
    {
        Bouncer::role()->whereName($role)->delete();

        return $role;
    }

    public function assignAbilities($role, $abilities = null)
    {
        if(!is_null($abilities)) {
            foreach($abilities as $ability) {
                Bouncer::allow($role)->to($ability);
            }
        }
    }

    public function updateRoleAbilities(string $role, array $abilities)
    {
        Bouncer::sync($role)->abilities(array_values($abilities));
    }
}
