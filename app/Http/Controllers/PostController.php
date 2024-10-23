<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function ProfileIndex(User $user) {
        $posts = Post::with(['user', 'comments.user'])
                    ->orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->get();

        $followingCount = DB::table('follows')
        ->where('followed_id', $user->id)
        ->count();

        $followersCount = DB::table('follows')
        ->where('user_id', $user->id)
        ->count();


        return view('profile.index', compact('posts', 'user', 'followersCount', 'followingCount'));
    }


    public function dashboardIndex()
    {

    $currentUser = User::findOrFail(Auth::id());

    $followedID = $currentUser->follows()->pluck('followed_id');

    $posts = Post::with(['user', 'comments.user'])
    ->whereIn('user_id', $followedID)
    ->orWhere('user_id', Auth::id())
    ->orderBy('created_at', 'desc')
    ->simplepaginate(5);

    return view('dashboard', compact('posts'));
}

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Bejegyzés sikeresen létrehozva!');
    }

}

