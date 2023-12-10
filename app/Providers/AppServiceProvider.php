<?php

namespace App\Providers;

use App\Repository\DBCategoryCourseRepository;
use App\Repository\DBCategoryFreeCourseRepository;
use App\Repository\DBCourseRepository;
use App\Repository\DBUsersRepository;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;
use App\Repositoryinterface\CategoryFreeCourseRepositoryinterface;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Repositoryinterface\UsersRepositoryinterface;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
