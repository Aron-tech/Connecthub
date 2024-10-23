<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(User $user): View
    {
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(User $user, Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($request->hasFile('image') && $request->image->isValid()) {
            if($user->image && $user->image!='profile-logo/default.jpg' && file_exists(storage_path('app/public/' . $user->image))) {
                unlink(storage_path('app/public/' . $user->image));
            }
            $imagePath = $request->image->store('profile-logo', 'public');
            $validatedData['image'] = $imagePath;
        }else {
            $validatedData['image'] = $user->avatar;
        }


        $user->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'avatar' => $validatedData['image'],
        ]);
        //dd(Auth::user(), $validatedData);
        return redirect()->back()->with('success', 'Profil sikeresen frissítve!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
