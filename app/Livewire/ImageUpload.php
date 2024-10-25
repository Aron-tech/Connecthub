<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $image;

    protected $rules = [
        'image' => 'nullable|image|max:20720',
    ];

    public function updatedImage()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.tesz');
    }
}
