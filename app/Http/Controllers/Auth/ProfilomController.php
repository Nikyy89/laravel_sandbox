<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\System_logs;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProfilomController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Add log in database
        System_logs::addToLog('Profilom', 'Profilom menüpont felület megjelenítése', 'ProfilomController', 'View');

        return view('auth.profilom', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user -> name = $request['name'];
        $user -> email = $request['email'];
        $user -> username = $request['username'];
        $user -> gender = $request['gender'];
        $user -> birth_date = $request['birth_date'];
        $user -> phone = $request['phone'];
        $user -> updated_at = date('Y-m-d');
        $user -> password = Hash::make($request['password']);
        $user -> save();

        // Add log in database
        System_logs::addToLog('ProfilomUpdate', 'Saját adatok frissítése', 'ProfilomController', 'ProfilomUpdate');

        return back()->with('message','Profile Updated');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $user = auth()->user();
        $request->file('image')->store('users', 'public');

        $new_profile_image = $user->update([
            'image_name' => $request->file('image')->getClientOriginalName(),
            'image_path' =>$request->file('image')->hashName()
        ]);

        // Add log in database
        System_logs::addToLog('web', 'Profilkép feltöltés', 'ProfilomController', 'ProfilomUploadImage');

        return redirect('profilom')->with('success', 'Image Has been uploaded successfully.');
    }
}
