<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Itt javítva van a névtér

class MutualFollowMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::findorfail(Auth::id());
        $otherUser = $request->route('user');

        $isMutualFollowOne = $user->isFollowing($otherUser);
        $isMutualFollowTwo = $otherUser->isFollowing($user);

        if (!$isMutualFollowOne || !$isMutualFollowTwo) {
            return redirect('/chat')->with('error', 'Kölcsönös követés szükséges a chat megnyitásához.');
        }
        return $next($request);
    }
}
