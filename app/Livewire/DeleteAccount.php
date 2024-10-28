<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Group; // Importáld a Group modellt

class DeleteAccount extends Component
{
    public $showDeleteModel = false;
    public $buttontext;
    public $boxtext;
    public $deletetype;
    public $groupId; // Csoport ID tárolása

    public function mount($deletetype = 'account', $buttontext = "Fiók törlése", $boxtext = 'Biztosan szeretne törölni a fiókodat?')
    {
        $this->buttontext = $buttontext;
        $this->boxtext = $boxtext;
        $this->deletetype = $deletetype;
    }

    public function confirmDeletion()
    {
        if ($this->deletetype == 'account') {
            $user = User::findOrFail(Auth::id());
            Auth::logout();
            $user->delete();

            return redirect('/')->with('success', 'Fiók sikeresen törölve!');
        } elseif ($this->deletetype == 'group') {
            $group = Group::findOrFail($this->groupId);
            $group->delete();
            return redirect('/groups')->with('success', 'Csoport sikeresen törölve!');
        }
    }

    public function render()
    {
        return view('livewire.delete-account');
    }
}
