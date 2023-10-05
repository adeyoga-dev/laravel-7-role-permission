<?php

namespace App\Http\Controllers\Auth;
// model
use App\Models\User;
use Spatie\Permission\Models\Role;
// package
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'numeric', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        //mendapatkan role
        $role = Role::find(2);
        //mendaftarkan user
        $user = User::create([
            'name' => $data['name'],
            'nik' => $data['nik'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        //memberikan role user
        $user->assignRole($role);
        //kirim hasil
        return $user;
    }
}
