<?php

use App\Http\Controllers\Api\V1\CategoryCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\CategoryFreeCourse;
use App\Http\Controllers\Api\V1\SetttingController;

Route::post('/login',[UsersController::class,'login'])->name('login');
Route::post('/sendotp',[UsersController::class,'sendotp']);
Route::post('/signup',[UsersController::class,'signup']);
Route::get('/homepage',[HomeController::class,'homepage'])->name('homepage');
Route::get('/verificationcode/{code?}',[UsersController::class,'verificationcode'])->name('signup');
Route::get('/category_course',[CategoryCourseController::class,'getcategorycourse'])->name('getcategorycourse');
// Route::get('/getcourses',[CourseController::class,'getcategorycourse'])->name('getcategorycourse');
Route::get('/getcourse/{category_id}',[CourseController::class,'getcourse'])->name('getcourse');
Route::get('/slider',[HomeController::class,'getslider'])->name('getslider');
Route::get('/setting',[HomeController::class,'getsetting'])->name('getsetting');
Route::get('/category/free/course',[CategoryFreeCourse::class,'getcategoryfreecourse'])->name('CFcourse');
Route::middleware(['jwt.verify'])->group(function () {


});
