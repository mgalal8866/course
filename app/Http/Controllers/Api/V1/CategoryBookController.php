<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\CategoryBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryBookResource;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;

class CategoryBookController extends Controller
{
    private $StudySchedule;
    public function __construct(CategoryBookRepositoryinterface $StudySchedule)
    {
        $this->StudySchedule = $StudySchedule;
    }

    function get_category_book()
    {
        $data= $this->StudySchedule->get_category_book();
          return Resp(CategoryBookResource::collection($data),'success');
    }
}
