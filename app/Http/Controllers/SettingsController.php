<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\PasswordChanged;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = User::findOrfail(Auth::id());

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->update();

        Mail::to($user->email)->send(new PasswordChanged($user));

        return redirect()->back()->with('success', 'Beállítások frissítve!');
    }


    public function delete()
    {
        $user = User::findorfail(Auth::id());
        $user->delete();

        Auth::logout();

        return redirect('/')->with('success', 'Fiók sikeresen törölve!');
    }
}
