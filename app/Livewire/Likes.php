<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
class Likes extends Component
{
    public $post;
    public $likeCount = 0;
    public $dislikeCount = 0;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->likeCount = $post->likes;
        $this->dislikeCount = $post->dislikes;
    }

    public function like(Post $post)
{
    $existingLike = Like::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->first();

    if ($existingLike) {
        if ($existingLike->is_like) {
            session()->flash('message', 'Már like-oltad ezt a posztot.');
            return;
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
    $this->likeCount = $post->likes;
    $this->dislikeCount = $post->dislikes;
}

public function dislike(Post $post)
{
    $existingLike = Like::where('user_id', Auth::id())
                        ->where('post_id', $post->id)
                        ->first();

    if ($existingLike) {
        if (!$existingLike->is_like) {
            session()->flash('message', 'Már dislike-oltad ezt a posztot.');
            return;
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
    $this->likeCount = $post->likes;
    $this->dislikeCount = $post->dislikes;
}
    public function render()
    {
        return view('livewire.likes');
    }
}
