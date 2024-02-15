<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;
use Illuminate\Http\Request;

class StudyScheduleController extends Controller
{
    private $StudySchedule;
    public function __construct(StudyScheduleRepositoryinterface $StudySchedule)
    {
        $this->StudySchedule = $StudySchedule;
    }

    function create_study_schedule(Request $request)
    {
        $data = $this->StudySchedule->create_study_schedule($request);
        if ($data) {
            return Resp('', 'success');
        } else {
            return Resp('error', 401);
        }
    }
}
