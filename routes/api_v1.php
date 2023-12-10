<?php
use Illuminate\Support\Facades\Route;


Route::get('/category/free/course',[CategoryFreeCourse::class,'getcategoryfreecourse'])->name('CFcourse');
Route::middleware(['jwt.verify'])->group(function () {


});
