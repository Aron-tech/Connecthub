<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentController extends Controller
{
    use HasFactory;

    public function store(Request $request)
{
    $request->validate([
        'body' => 'required|string|max:500',
        'post_id' => 'required|exists:posts,id',
    ]);

    Comment::create([
        'user_id' => Auth::user()->id,
        'post_id' => $request->post_id,
        'body' => $request->body,
    ]);

    return redirect()->back()->with('success', 'Komment sikeresen létrehozva!');
}

}
