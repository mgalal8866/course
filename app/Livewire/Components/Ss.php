<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('components.fileupload');
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'file|max:8192', // 8MB Max
        ]);

        $this->emitUp('fileUploaded', $this->file);
    }

    public function fileComplete()
    {
        $this->emitUp('fileUpload', $this->file->getRealPath());
    }

    public function fileReset()
    {
        $this->emitUp('fileReset');
    }
}
