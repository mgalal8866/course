<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\SetttingController;
use App\Http\Controllers\Api\V1\FreeCourseController;
use App\Http\Controllers\Api\V1\CategoryCourseController;
use App\Http\Controllers\Api\V1\CategoryFreeCourseController;

Route::post('/login',[UsersController::class,'login'])->name('login');
Route::post('/sendotp',[UsersController::class,'sendotp']);
Route::post('/signup',[UsersController::class,'signup']);

Route::get('/home',[HomeController::class,'homep'])->name('homep');
Route::get('/home/section1',[HomeController::class,'section1'])->name('section1');
Route::get('/home/section2',[HomeController::class,'section2'])->name('section2');
Route::get('/home/section3',[HomeController::class,'section3'])->name('section3');
Route::get('/home/section4',[HomeController::class,'section4'])->name('section4');
Route::get('/home/section5',[HomeController::class,'section5'])->name('section5');
Route::get('/home/section6',[HomeController::class,'section6'])->name('section6');
Route::get('/home/section7',[HomeController::class,'section7'])->name('section7');
Route::get('/home/section8',[HomeController::class,'section8'])->name('section8');
Route::get('/home/header',[HomeController::class,'homeheader'])->name('homeheader');
Route::get('/home/footer',[HomeController::class,'homefooter'])->name('homefooter');

Route::get('/verificationcode/{code?}',[UsersController::class,'verificationcode'])->name('signup');
Route::get('/category_course',[CategoryCourseController::class,'getcategorycourse'])->name('getcategorycourse');
// Route::get('/getcourses',[CourseController::class,'getcategorycourse'])->name('getcategorycourse');
Route::get('/courses/{category_id}',[CourseController::class,'getcoursesbycategroy'])->name('getcoursesbycategroy');
Route::get('/course/{id}',[CourseController::class,'getcoursebyid'])->name('getcoursebyid');
Route::get('/slider',[HomeController::class,'getslider'])->name('getslider');
Route::get('/setting',[HomeController::class,'getsetting'])->name('getsetting');
Route::get('/category/free/course',[CategoryFreeCourseController::class,'getcategoryfreecourse']);
Route::get('/free/course/{id?}',[FreeCourseController::class,'get_free_course_by_category']);
Route::middleware(['jwt.verify'])->group(function () {


});
