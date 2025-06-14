<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImage extends Component
{
    use WithFileUploads;

    public $image;

    protected $rules = [
        'image' => 'nullable|image|max:5120',
    ];

    public function updatedImage()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.upload-image');
    }
}
