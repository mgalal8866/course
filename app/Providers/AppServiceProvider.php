<?php

namespace App\Providers;

use App\Models\Courses;
use App\Models\FreeCourse;
use App\Repository\DBUsersRepository;
use App\Repository\DBCourseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DBFreeCourseRepository;
use App\Repository\DBCategoryCourseRepository;
use App\Repository\DBCategoryFreeCourseRepository;
use App\Repository\DBCategoryGradesRepository;
use App\Repository\DBCommentsRepository;
use App\Repository\DBUsersGradesRepository;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Repositoryinterface\FreeCourseRepositoryinterface;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;
use App\Repositoryinterface\CategoryGradesRepositoryinterface;
use App\Repositoryinterface\CommentsRepositoryinterface;
use App\Repositoryinterface\UsersGradesRepositoryinterface;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersRepositoryinterface::class, DBUsersRepository::class);
        $this->app->bind(CourseRepositoryinterface::class, DBCourseRepository::class);
        $this->app->bind(CategoryCourseRepositoryinterface::class, DBCategoryCourseRepository::class);
        $this->app->bind(CategoryFreeCourseRepositoryinterface::class, DBCategoryFreeCourseRepository::class);
        $this->app->bind(FreeCourseRepositoryinterface::class, DBFreeCourseRepository::class);
        $this->app->bind(UsersGradesRepositoryinterface::class, DBUsersGradesRepository::class);
        $this->app->bind(CategoryGradesRepositoryinterface::class, DBCategoryGradesRepository::class);
        $this->app->bind(CommentsRepositoryinterface::class, DBCommentsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'course'=> Courses::class,
            'freecourse'=>FreeCourse::class
        ]);
    }
}
