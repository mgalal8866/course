<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\PaymentMethods;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Repositoryinterface\CourseRepositoryinterface;

class PaymentsController extends Controller
{

    public function get_payment()
    {
        return PaymentResource::collection(PaymentMethods::get());
    }
    public function payment_callback(Request $request)
    {
        PaymentTransaction::where( 'response->data->invoice_id', $request->invoice_id)
    ->update( ['response->status' => $request->status,'statu'=>$request->status =='success'?1:2]);

        return    Resp( $request->all(), 'success', 200, true);
    }
}
