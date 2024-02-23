<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Quizes;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\ResultQuizRepositoryinterface;

class DBResultQuizRepository implements ResultQuizRepositoryinterface
{


    protected Model $model;
    protected $request;

    public function __construct(Quizes $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function  send_answers()
    {
        dd( $this->request);
    }
}
