<?php

namespace App\Providers;

use App\Repository\DBUsersRepository;
use App\Repository\DBCourseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DBFreeCourseRepository;
use App\Repository\DBCategoryCourseRepository;
use App\Repository\DBCategoryFreeCourseRepository;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Repositoryinterface\FreeCourseRepositoryinterface;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
