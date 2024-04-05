<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\PaymentMethods;
use App\Repositoryinterface\CourseRepositoryinterface;

class PaymentsController extends Controller
{

    public function get_payment()
    {
        return PaymentResource::collection(PaymentMethods::get());
    }
}
