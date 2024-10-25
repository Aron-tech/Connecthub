<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Like;

use function Pest\Laravel\post;

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
        'image' => 'nullable|image|max:30720',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('post-images', 'public');
    }

    Post::create([
        'user_id' => Auth::id(),
        'body' => $request->body,
        'image' => $imagePath,
    ]);
    return redirect()->back()->with('success', 'Bejegyzés sikeresen létrehozva!');
}



    public function like(Post $post)
{
    $existingLike = Like::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->first();

    if ($existingLike) {
        if ($existingLike->is_like) {
            return redirect()->back()->with('message', 'Már like-oltad ezt a posztot.');
        } else {
            $existingLike->update(['is_like' => true]);
            $post->increment('likes');
            $post->decrement('dislikes');
        }
    } else {
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'is_like' => true,
        ]);
        $post->increment('likes');
    }

    $post->save();
    return redirect()->back();
}

public function dislike(Post $post)
{
    $existingLike = Like::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->first();

    if ($existingLike) {
        if (!$existingLike->is_like) {
            return redirect()->back()->with('message', 'Már dislike-oltad ezt a posztot.');
        } else {
            $existingLike->update(['is_like' => false]);
            $post->increment('dislikes');
            $post->decrement('likes');
        }
    } else {
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'is_like' => false,
        ]);
        $post->increment('dislikes');
    }

    $post->save();
    return redirect()->back();
}
}

