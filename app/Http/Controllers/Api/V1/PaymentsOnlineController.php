<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use App\Repositoryinterface\CourseRepositoryinterface;

class PaymentsOnlineController extends Controller
{

public function get_payment(){
    return PaymentMethods::with('PaymentMethodCredentials')->get();
}
}
