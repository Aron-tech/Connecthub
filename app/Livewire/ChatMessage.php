<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Message;
use App\Models\User;

class ChatMessage extends Component
{
    public $messages;
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadMessages();
    }

    public function refreshMessages()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::with('sender')
            ->where(function ($query) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $this->user->id);
            })
            ->orWhere(function ($query) {
                $query->where('sender_id', $this->user->id)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.chatmessage');
    }
}

