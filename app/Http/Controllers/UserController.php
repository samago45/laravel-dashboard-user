<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        // Definir las columnas según sea necesario
        $columnas = [
            ['name' => 'ID', 'selector' => fn($user) => $user->id],
            ['name' => 'Nombre', 'selector' => fn($user) => $user->name],
            ['name' => 'Apellido', 'selector' => fn($user) => $user->last_name],
            ['name' => 'Telefono', 'selector' => fn($user) => $user->phone],
            ['name' => 'Correo', 'selector' => fn($user) => $user->email],

        ];
        return view('dashboard', compact('users', 'columnas'));
    }

    public function create()
    {
        return view('dashboard');
    }


    public function store(Request $request)
    {

        /*dd($request->all());*/
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);


        return redirect()->route("dashboard");


    }

    /*public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index');
    }
*/
    public function destroy(User $user)
    {
     /*   dd($user->all());*/
        $user->delete();
        return redirect()->route('dashboard');
    }


}
