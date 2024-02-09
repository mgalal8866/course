<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Repositoryinterface\UsersGradesRepositoryinterface;
use Illuminate\Http\Request;

class UsersGradesController extends Controller
{
    private $grades;
    public function __construct(UsersGradesRepositoryinterface $grades)
    {
        $this->grades = $grades;
    }

    public function get_grades_by_category( $id)
    {
      return  $this->grades->get_grades_by_category($id);
    }


}
