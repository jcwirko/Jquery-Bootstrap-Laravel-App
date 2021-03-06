<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\BouncerFacade as Bouncer;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $users = User::with('roles')->orderBy('first_name')->get();
        $roles = Bouncer::role()->all();

        return view('users.index', compact('users', 'roles'));
    }

    public function store(UserRequest $request)
    {
        $request['password'] = Hash::make($request->password);

        $user = $this->repository->store(new User($request->all()));
        $this->repository->assignRole($user, $request->input('roles'));

        toast('Usuario creado', 'success');

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $this->repository->delete($user);

        toast('Usuario eliminado', 'success');

        return redirect()->route('users.index');
    }

    public function showProfileForm()
    {
        return view('users.profile');
    }

    public function setProfileData(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', "unique:users,email,".auth()->user()->id],
        ]);

        $user = auth()->user();
        $user->fill($request->all());
        $user->save();

        toast('Perfil actualizado', 'success');

        return redirect()->back();
    }

    public function setPassword(Request $request)
    {
        if(!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            return redirect()->back()->with("error",
                "La contraseña actual no coincide con la registrada. Inténtelo de nuevo.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with("error",
                "La nueva contraseña no puede ser igual a la actual. Por favor, elija una diferente");
        }

        $request->validate([
            'new-password' => ['required']
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        toast('Contraseña actualizada', 'success');

        return redirect()->back();
    }

    public function updateRoles(User $user)
    {
        $roles = request()->input('roles');

        Bouncer::sync($user)->roles($roles);

        toast('Roles del usuario actualizado', 'success');

        return redirect()->route('users.index');
    }
}
