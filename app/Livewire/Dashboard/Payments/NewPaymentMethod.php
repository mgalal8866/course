<?php

namespace App\Livewire\Dashboard\Payments;

use Livewire\Component;
use App\Models\PaymentMethods;

class NewPaymentMethod extends Component
{

    protected $listeners = ['edit' => 'edit'];
    public  $active, $name, $edit = false, $id, $header;
    protected $rules = [
        'name'       => 'required',

    ];

    public function edit($id = null)
    {
        $this->edit = false;
        if ($id != null) {
            $tra = PaymentMethods::find($id);
            $this->id = $tra->id;
            $this->name = $tra->name;
            $this->active = $tra->active==1?true:false;
            $this->edit = true;
            $this->header = __('tran.edit') . ' ' . __('tran.paymentmethod');
        } else {
            $this->name = null;
            $this->edit = false;
            $this->header =  __('tran.add') . ' ' . __('tran.paymentmethod');
        }
        $this->dispatch('openmodel');
    }

    public function save()
    {
        $this->validate();
        $CFC = PaymentMethods::updateOrCreate(['id' => $this->id], [
            'name'       => $this->name,
            'active' => $this->active??1
        ]);
        $this->dispatch('closemodel');
        $this->dispatch('paymentmethod_refresh');

    }
    public function render()
    {
        $paymentmethod  = PaymentMethods::latest()->get();
        return view('dashboard.payment_method.new-payment_method', compact('paymentmethod'));
    }
}
