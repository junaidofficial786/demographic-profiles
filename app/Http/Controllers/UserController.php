<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function createUser()
    {
        return view('users.create');
    }

    public function storeUser(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'age' => ['required', 'integer', 'min:10'],
            'gender' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required',  'string'],
            'employement_status' => ['required',  'string'],
            'degree_level' => ['required',  'string'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'approved' => 1,
            'age' => $request->age,
            'gender' => $request->gender,
            'province' => $request->province,
            'city' => $request->city,
            'employement_status' => $request->employement_status,
            'degree_level' => $request->degree_level,
        ];

        $user = User::create($data);

        return back()->with('success', "User ".$user->name." has been created.");
    }
}
