<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use App\Notifications\CustomPasswordResetNotification;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Felhasználó keresése az email alapján
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => __('Nem található felhasználó ezzel az email címmel.'),
            ]);
        }

        // Token létrehozása
        $token = Password::createToken($user);

        // Egyedi értesítés küldése
        $user->notify(new CustomPasswordResetNotification($token));

        return back()->with('status', __('A jelszó visszaállítási linket elküldtük az email címre.'));
    }
}
