<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\FreeCourse\FreeCourse;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Livewire\Dashboard\FreeCourse\Category\CategoryFreeCourse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/dashboard/' ,
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::get('/', function () { return view('layouts.dashboard.app'); });
        Route::get('/free-course', FreeCourse::class)->name('freecourse');
        Route::get('/category/free-course', CategoryFreeCourse::class)->name('categoryfree');
    }
);

