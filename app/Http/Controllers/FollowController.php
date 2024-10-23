<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{

     public function listfollow(Request $request) {

        $search = $request->input('search');

        $users = User::where('id', '!=', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->simplePaginate(16);

        $title = 'Összes felhasználó';

        return view('follow', compact('users', 'title'));
    }

    public function indexFollower(User $user)
    {
        $title = 'Követők';

        $users = $user->followers()->simplePaginate(16);

        return view('follow', compact('users', 'title'));
    }

    public function indexFollowed(User $user)
    {
        $title = 'Követések';

        $users = $user->follows()->simplePaginate(16);

        return view('follow', compact('users', 'title'));
    }

     public function toggleFollow(User $user)
{
    $currentUser = User::findOrFail(Auth::id());
    $userToFollow = User::findOrFail($user->id);

    $isFollowing = $currentUser->follows()->where('followed_id', $userToFollow->id)->exists();

    if ($isFollowing) {
        $currentUser->follows()->detach($userToFollow->id);
        return back()->with('success', 'Sikeresen kikövetted!');
    } else {
        $currentUser->follows()->attach($userToFollow->id);
        return back()->with('success', 'Sikeresen bekövetted!');
    }
}

    public function addfollow($userId)
    {

        $currentUser = User::findOrFail(Auth::id());

        $userToFollow = User::findOrFail($userId);


        $isAlreadyFollowing = $currentUser->follows()->where('followed_id', $userToFollow->id)->exists();

        if (!$isAlreadyFollowing) {

            $currentUser->follows()->attach($userToFollow->id);


            return back()->with('success', 'Sikeresen bekövetted!');
        }


        return back()->with('error', 'Már követed ezt a felhasználót!');
    }
}
