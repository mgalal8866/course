<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SetttingController extends Controller
{
    protected Model $model;
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
    public function getsetting()
    {
        return Resp($this->model::get(),'success');
    }


}
