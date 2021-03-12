<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use Silber\Bouncer\BouncerFacade as Bouncer;

class RoleController extends Controller
{
    private $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $roles = Bouncer::role()->orderBy('id', 'asc')->get();
        $abilities = Bouncer::ability()->all();

        return view('roles.index', compact('roles', 'abilities'));
    }

    public function store(RoleRequest $request)
    {
        $role = $this->repository->store($request->input('name'), $request->title);

        $this->repository->assignAbilities($role->name, $request->input('abilities'));

        toast("Rol $role->name creado", 'success');

        return redirect()->back();
    }

    public function update(RoleRequest $request, $actualRole)
    {
        $data[$actualRole] = $request->input('abilities');

        $this->updateRoleAbilities($data);
        $this->repository->update($actualRole, $request->input('name'), $request->input('title'));

        toast('Rol actualizado', 'success');

        return redirect()->route('roles.index');
    }

    public function destroy($role)
    {
        $this->repository->destroy($role);

        toast("Rol eliminado", 'success');

        return redirect()->back();
    }

    public function getGrid()
    {
        $roles = Bouncer::role()->orderBy('id', 'asc')->get();
        $abilities = Bouncer::ability()->all();

        return view('roles.grid', compact('roles', 'abilities'));
    }

    public function updateGrid()
    {
        $roles = request()->input('roles');

        $this->updateRoleAbilities($roles);

        toast('Roles y permisos establecidos', 'success');

        return redirect()->back();
    }

    private function updateRoleAbilities(array $rolesAbilities)
    {
        foreach($rolesAbilities as $role => $abilities) {
            $this->repository->updateRoleAbilities($role, $abilities);
        }
    }
}
