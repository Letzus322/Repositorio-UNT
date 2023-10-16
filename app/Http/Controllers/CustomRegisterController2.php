<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CustomRegisterController2 extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function redirectTo()
    {
        return url()->previous();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type'=> 0,
        ]);
    }

    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Lógica adicional si es necesaria antes de crear al usuario

        $user = $this->create($request->all());

        // Iniciar sesión automáticamente después del registro

        return $this->registered($request, $user)
                    ?: redirect($this->redirectPath());
    }
}
