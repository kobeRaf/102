<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function view() {
        return view('settings.index');
    }

    public function manageUser() {
        $users = User::all();
        return view('settings.users', compact('users'));
    }

    public function storeUser(Request $request) {
        $request->validate([
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'name' => 'required|string|max:255', // full name
            'password' => 'required|string|min:4',
            'user_type' => 'required|string',
        ]);

        $refno = 'USER-' . date('Ymd') . '-' . rand(10000, 99999);

        User::create([
            'ref_no' => $refno,
            'user_name' => $request->user_name,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        return redirect()->back()->with('success', 'User added successfully!');
    }

    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);

        $user->update([
            'user_name' => $request->user_name,
            'name' => $request->name,
            'user_type' => $request->user_type,
            'password' => $request->password 
                ? Hash::make($request->password) 
                : $user->password,
        ]);

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
