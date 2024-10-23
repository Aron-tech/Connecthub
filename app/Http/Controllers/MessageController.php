<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;


class MessageController extends Controller
{
        public function index(Request $request)
        {
            $title = 'Chat választó';

            $currentUser = Auth::user();

            $searchTerm = $request->input('search');

            $users = User::when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', "%{$searchTerm}%");
            })
            ->where('id', '!=', $currentUser->id)

            ->whereHas('follows', function ($query) use ($currentUser) {
                $query->where('followed_id', $currentUser->id);
            })
            ->whereHas('followers', function ($query) use ($currentUser) {
                $query->where('user_id', $currentUser->id);
            })
            ->simplePaginate(16);

            return view('chat.index', compact('users', 'title'));
        }

        public function show(User $user)
        {
          /* $messages = Message::with('sender', 'receiver')
                ->where(function ($query) use ($user) {
                    $query->where('sender_id', Auth::id())
                          ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                          ->where('receiver_id', Auth::id());
                })
                ->orderBy('created_at', 'asc')
                ->get();*/

            //return view('chat.show', compact('messages', 'user'));
            return view('chat.show', compact('user'));
        }

   public function store(Request $request, User $user){
        {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $user->id,
                'message' => $request->input('message')
            ]);

            return redirect()->back();
        }
    }
}
