<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeleteAccount extends Component
{
    public $showDeleteModel = false;

    public function confirmDeletion()
    {
        $user = User::findorfail(Auth::id());
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Fiók sikeresen törölve!');
    }

    public function render()
    {
        return view('livewire.delete-account');
    }
}
