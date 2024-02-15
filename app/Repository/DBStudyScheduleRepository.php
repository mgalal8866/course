<?php

namespace App\Repository;

use App\Models\StudySchedule;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;

class DBStudyScheduleRepository implements StudyScheduleRepositoryinterface
{

    protected Model $model;
    public function __construct(StudySchedule $model)
    {
        $this->model = $model;
    }

    public function create_study_schedule($request)
    {
       
        $study_schedule = StudySchedule::create($request->only([
            'name',
            'phone',
            'subject',
            'start_page',
            'end_page',
            'days',
            'start_date',
        ]));

       return $study_schedule ? true:false;
    }
}
