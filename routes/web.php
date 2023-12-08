<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\FreeCourse\FreeCourse;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        Route::get('/', function () {
            return view('layouts.Dashboard.app');
        });
        Route::get('/free-course', FreeCourse::class)->name('freecourse');
    }
);
