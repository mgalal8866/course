<?php

namespace App\Livewire\Dashboard\Quizzes;

use Livewire\Component;

class DeleteModal extends Component
{
    public $modalHeading = '';
    public $modalMessage = '';
    public $showModal = '';
    public $model ;
    protected $listeners = ['showModal' ];
    public function showModal($modelType, $modalId, $modalHeading, $modalMessage)
    {
        $this->showModal = true;
        $this->model    = $modelType::findOrFail($modalId);
        $this->modalHeading = $modalHeading;
        $this->modalMessage = $modalMessage;
    }
    public function destroy()
    {
        try{

            $this->model->delete();
            $this->dispatch('refreshComponent');
            $this->dispatch('swal', message: 'تم انشاء الدورة بنجاح');

            $this->showModal = false;
        }catch(\Exception $e){

        }

    }
    public function render()
    {
        return view('dashboard.quizzes.delete-modal');
    }
}
