<?php

namespace App\Providers;

use App\Models\Courses;
use App\Models\FreeCourse;
use App\Repository\DBCartRepository;
use App\Repository\DBUsersRepository;
use App\Repository\DBCourseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DBCommentsRepository;
use App\Repository\DBWishlistRepository;
use App\Repository\DBStoreBookRepository;
use App\Repository\DBFreeCourseRepository;
use App\Repository\DBUsersGradesRepository;
use App\Repository\DBCategoryBookRepository;
use App\Repository\DBStudyScheduleRepository;
use App\Repository\DBCategoryCourseRepository;
use App\Repository\DBCategoryGradesRepository;
use App\Repository\DBCourseEnrolledRepository;
use App\Repository\DBCategoryFreeCourseRepository;
use App\Repositoryinterface\CartRepositoryinterface;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Repositoryinterface\CommentsRepositoryinterface;
use App\Repositoryinterface\WishlistRepositoryinterface;
use App\Repositoryinterface\StoreBookRepositoryinterface;
use App\Repositoryinterface\FreeCourseRepositoryinterface;
use App\Repositoryinterface\UsersGradesRepositoryinterface;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use App\Repositoryinterface\StudyScheduleRepositoryinterface;
use App\Repositoryinterface\CategoryCourseRepositoryinterface;
use App\Repositoryinterface\CategoryGradesRepositoryinterface;
use App\Repositoryinterface\CourseEnrolledRepositoryinterface;
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
        $this->app->bind(UsersGradesRepositoryinterface::class, DBUsersGradesRepository::class);
        $this->app->bind(CategoryGradesRepositoryinterface::class, DBCategoryGradesRepository::class);
        $this->app->bind(CommentsRepositoryinterface::class, DBCommentsRepository::class);
        $this->app->bind(StoreBookRepositoryinterface::class, DBStoreBookRepository::class);
        $this->app->bind(StudyScheduleRepositoryinterface::class, DBStudyScheduleRepository::class);
        $this->app->bind(CategoryBookRepositoryinterface::class, DBCategoryBookRepository::class);
        $this->app->bind(CourseEnrolledRepositoryinterface::class, DBCourseEnrolledRepository::class);
        $this->app->bind(CartRepositoryinterface::class, DBCartRepository::class);
        $this->app->bind(WishlistRepositoryinterface::class, DBWishlistRepository::class);
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
