<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    //protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:50', 'unique:users'],
            'gender' => ['required', 'string', 'max:15'],
            'birth_date' => ['required', 'date', 'unique:users'],
            //'phone' => ['required', 'regex:/^\+(?:[0-9] ?){6,14}[0-9]$/', 'unique:users'],
            //'phone' => ['required', 'string', 'max:25'],
            'phone' => ['required', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image_name' => ['required', 'string', 'unique:users'],
            'image_path' => ['required', 'string', 'unique:users']
        ]);
    }

    protected function create(array $data)
    {
        $user = auth()->user();
        //$data->file('image')->store('users', 'public');

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'image_name' => is_null(),
            'image_path' => is_null()
        ])->toSql();

        ddd($data);


        return redirect('login')->with('success', 'Your account has been created');
    }

/*
    public function upload_image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $user = auth()->user();
        $request->file('image')->store('users', 'public');

        $new_register_profile_image = $user->create([
            'image_name' => $request->file('image')->getClientOriginalName(),
            'image_path' =>$request->file('image')->hashName()
        ]);

        return redirect('register')->with('success', 'Image Has been uploaded successfully.');
    }
*/
}
