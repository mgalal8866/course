<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CategoryFreeCourse;


Route::get('/category/free/course',[CategoryFreeCourse::class,'getcategoryfreecourse'])->name('CFcourse');
Route::middleware(['jwt.verify'])->group(function () {


});
