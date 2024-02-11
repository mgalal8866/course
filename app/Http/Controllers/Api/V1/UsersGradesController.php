<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsergradesResource;
use App\Repositoryinterface\UsersGradesRepositoryinterface;

class UsersGradesController extends Controller
{
    private $grades;
    public function __construct(UsersGradesRepositoryinterface $grades)
    {
        $this->grades = $grades;
    }

    public function get_grades_by_category( $id)
    {
       return Resp( UsergradesResource::collection($this->grades->get_grades_by_category($id)),'success');
    }


}
