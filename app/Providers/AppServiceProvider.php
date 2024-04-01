<?php

namespace App\Providers;

use App\Models\Courses;
use App\Models\FreeCourse;
use App\Models\CategoryBlog;
use App\Models\CategoryQuiz;
use App\Repository\DBFqaRepository;
use App\Repository\DBBlogRepository;
use App\Repository\DBCartRepository;
use App\Repository\DBQuizRepository;
use App\Repository\DBOrderRepository;
use App\Repository\DBUsersRepository;
use App\Repository\DBCouponRepository;
use App\Repository\DBCourseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\DBCommentsRepository;
use App\Repository\DBWishlistRepository;
use App\Repository\DBContentUsRepository;
use App\Repository\DBStoreBookRepository;
use App\Repository\DBFreeCourseRepository;
use App\Repository\DBResultQuizRepository;
use App\Repository\DBUsersGradesRepository;
use App\Repository\DBCategoryBlogRepository;
use App\Repository\DBCategoryBookRepository;
use App\Repository\DBCategoryQuizRepository;
use App\Repository\DBStudyScheduleRepository;
use App\Repository\DBCategoryCourseRepository;
use App\Repository\DBCategoryGradesRepository;
use App\Repository\DBCourseEnrolledRepository;
use App\Repository\DBCategoryFreeCourseRepository;
use App\Repositoryinterface\FqaRepositoryinterface;
use App\Repositoryinterface\BlogRepositoryinterface;
use App\Repositoryinterface\CartRepositoryinterface;
use App\Repositoryinterface\QuizRepositoryinterface;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Repositoryinterface\OrderRepositoryinterface;
use App\Repositoryinterface\UsersRepositoryinterface;
use App\Repositoryinterface\CouponRepositoryinterface;
use App\Repositoryinterface\CourseRepositoryinterface;
use App\Repositoryinterface\CommentsRepositoryinterface;
use App\Repositoryinterface\WishlistRepositoryinterface;
use App\Repositoryinterface\ContentUsRepositoryinterface;
use App\Repositoryinterface\StoreBookRepositoryinterface;
use App\Repositoryinterface\FreeCourseRepositoryinterface;
use App\Repositoryinterface\ResultQuizRepositoryinterface;
use App\Repositoryinterface\UsersGradesRepositoryinterface;
use App\Repositoryinterface\CategoryBlogRepositoryinterface;
use App\Repositoryinterface\CategoryBookRepositoryinterface;
use App\Repositoryinterface\CategoryQuizRepositoryinterface;
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

        $repositories = [
            UsersRepositoryinterface::class               => DBUsersRepository::class,
            CourseRepositoryinterface::class              => DBCourseRepository::class,
            CategoryCourseRepositoryinterface::class      => DBCategoryCourseRepository::class,
            CategoryFreeCourseRepositoryinterface::class  => DBCategoryFreeCourseRepository::class,
            FreeCourseRepositoryinterface::class       => DBFreeCourseRepository::class,
            UsersGradesRepositoryinterface::class      => DBUsersGradesRepository::class,
            CategoryGradesRepositoryinterface::class   => DBCategoryGradesRepository::class,
            CommentsRepositoryinterface::class         => DBCommentsRepository::class,
            StoreBookRepositoryinterface::class        => DBStoreBookRepository::class,
            StudyScheduleRepositoryinterface::class    => DBStudyScheduleRepository::class,
            CategoryBookRepositoryinterface::class     => DBCategoryBookRepository::class,
            CourseEnrolledRepositoryinterface::class   => DBCourseEnrolledRepository::class,
            CartRepositoryinterface::class             => DBCartRepository::class,
            WishlistRepositoryinterface::class         => DBWishlistRepository::class,
            CategoryQuizRepositoryinterface::class     => DBCategoryQuizRepository::class,
            QuizRepositoryinterface::class             => DBQuizRepository::class,
            ResultQuizRepositoryinterface::class       => DBResultQuizRepository::class,
            BlogRepositoryinterface::class             => DBBlogRepository::class,
            CategoryBlogRepositoryinterface::class     => DBCategoryBlogRepository::class,
            CouponRepositoryinterface::class           => DBCouponRepository::class,
            OrderRepositoryinterface::class            => DBOrderRepository::class,
            ContentUsRepositoryinterface::class        => DBContentUsRepository::class,
            FqaRepositoryinterface::class              => DBFqaRepository::class,
        ];

        foreach ($repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
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
