<?php

namespace App\Livewire\Dashboard\Payments;

use Livewire\Component;
use App\Models\PaymentMethods;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
class NewPaymentMethod extends Component
{
    use WithFileUploads, ImageProcessing;
    protected $listeners = ['edit' => 'edit'];
    public  $imagold=null,$active, $name, $image, $account_name, $account_number, $type, $iban_number, $edit = false, $id, $header;
    protected $rules = [
        'name'       => 'required',

    ];

    public function edit($id = null)
    {
        $this->edit = false;
        if ($id != null) {
            $this->reset(['name','imagold','account_number','account_name','iban_number']);
            $tra = PaymentMethods::find($id);
            // dd($tra->type->value);
            $this->id = $tra->id;
            $this->type = 1;
            $this->name = $tra->name;
            $this->imagold = $tra->image !=null ? $tra->imageurl:null;
            $this->account_number = $tra->account_number;
            $this->account_name = $tra->account_name;
            $this->iban_number = $tra->iban_number;
            $this->active = $tra->active == 1 ? true : false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.paymentmethod');
        } else {

            $this->image =null;
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.paymentmethod');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {
        $this->validate();
        $CFC = PaymentMethods::updateOrCreate(['id' => $this->id], [
            'type'           => 1,
            'name'           => $this->name,
            'account_number' => $this->account_number,
            'account_name'   => $this->account_name,
            'iban_number'    => $this->iban_number,
            'active'         => $this->active ==true? 1:0
        ]);
        if ($this->image) {
            $dataX = $this->saveImageAndThumbnail($this->image, false,  null,null,'payment');
            $CFC->image =  $dataX['image'];
            $CFC->save();
        }
        $this->reset(['name','imagold','account_number','account_name','iban_number']);
        $this->dispatch('closemodel');
        $this->dispatch('paymentmethod_refresh');
    }
    public function render()
    {
        $paymentmethod  = PaymentMethods::latest()->get();
        return view('dashboard.payment_method.new-payment_method', compact('paymentmethod'));
    }
}
