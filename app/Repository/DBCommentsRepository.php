<?php

namespace App\Repository;

use App\Models\CategoryGrades;
use App\Models\Comments;
use App\Models\Courses;
use App\Models\FreeCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Repositoryinterface\CommentsRepositoryinterface;

class DBCommentsRepository implements CommentsRepositoryinterface
{

    protected Model $model;
    public function __construct(Comments $model)
    {
        $this->model = $model;
    }
    public function add_comment_course($request)
    {
        $course = Courses::find($request->id_course);
        if($course == null){
            return null;
        }
        $course->comments()->create([
            'body' => $request->body,
            'rating' => $request->rating
        ]);
    
        return $course->comments()->latest()->first();
    }
    public function add_comment_freecourse($request)
    {
        $course = FreeCourse::find($request->id_course);
        if($course == null){
            return null;
        }
        $course->comments()->create([
            'body' => $request->body,
            'reting' => $request->rating
        ]);
        return $course->comments()->latest()->first();
    }
}
