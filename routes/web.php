<?php

use GuzzleHttp\Client;
use Livewire\Livewire;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use App\Livewire\Dashboard\Blog\ViewBlog;
use App\Livewire\Dashboard\Exams\Newquiz;
use Stevebauman\Location\Facades\Location;
use App\Livewire\Dashboard\Exams\ViewQuizz;
use App\Livewire\Dashboard\Courses\NewCourse;
use App\Livewire\Dashboard\Trainees\Trainees;
use App\Livewire\Dashboard\Trainers\Trainers;
use App\Livewire\Dashboard\FreeCourse\FreeCourse;
use App\Livewire\Dashboard\Exams\Category\CategoryExam;
use App\Livewire\Dashboard\Trainers\Specialist\Specialist;
use App\Livewire\Dashboard\Courses\Category\CategoryCourse;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Livewire\Dashboard\FreeCourse\Category\CategoryFreeCourse;

// use Browser;

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
        'prefix' => LaravelLocalization::setLocale() . '/dashboard/',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::get('/test/{text?}', function (Request $request) {

            $url = 'https://api.openai.com/v1/chat/completions';

            $response = Http::withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer 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",
            ])->post($url, [

                'model' => "gpt-3.5-turbo",
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    // ['role' => 'user', 'content' => 'this is blog post title:'.PHP_EOL.'help pepole'.PHP_EOL. 'Improve it for SEO and provide 6 alterntive titles to lang arabic'],
                    ['role' => 'user', 'content' => 'Translate the following English text to arabic: "'.$request->text.'"'],
                ],
                'temperature' => 0,
                'max_tokens' => 3900,
            ]);
            $rr =  $response->json();
            $ar=    array_slice(preg_split('/\r\n|\r|\n/',$rr['choices'][0]['message']['content']),-5,5);
            // dd ($rr['choices'][0]['message']['content']
            dd ($ar);



            // Session::put('token', 'asdasdasd');
            // Cache::Forever('token', 'asdasdasd');
            // return app('getSettings');

            // return   Browser::browserName() .' - '.Browser::platformName() .' - '.$request->ip() .' - ' .   json_decode( json_encode(Location::get($request->ip())), true);
            // return    json_decode( json_encode(Location::get($request->ip())), true);


            //   $p1 = asset('files/1.jpg');
            // $p1 = public_path('\files\1.jpg');
            // $p2 = public_path('\files\watermark.png');

            // $watermark = Image::make($p2);
            // $watermark->rotate(45);

            // $image = Image::make($p1);
            // // $image->blur(18);
            // $image->greyscale();

            // // $imageWidth = $image->width();
            // // $imageHeight = $image->height();
            // // $positionX = ($imageWidth - $watermark->width()) / 2;
            // // $positionY = ($imageHeight - $watermark->height()) / 2;
            // // // $image->insert($p2, 'center',  number_format($positionX),  number_format($positionY));
            // $image->insert($watermark, 'center');
            // return $image->response('jpg');
        });
        Route::get('/', function () {
            return view('layouts.dashboard.app');
        });
        Route::get('/free-course', FreeCourse::class)->name('freecourse');
        Route::get('/course', NewCourse::class)->name('course');
        Route::get('/category/free-course', CategoryFreeCourse::class)->name('categoryfree');
        Route::get('/category/courses', CategoryCourse::class)->name('category');
        Route::get('/category/exam', CategoryExam::class)->name('examcategory');
        Route::get('/new/quiz', Newquiz::class)->name('newquiz');
        Route::get('/view/quiz', ViewQuizz::class)->name('viewquiz');
        Route::get('/trainers', Trainers::class)->name('trainers');
        Route::get('/trainees', Trainees::class)->name('trainees');
        Route::get('/specialist', Specialist::class)->name('specialist');
        Route::get('/blog', ViewBlog::class)->name('blog');
    }
);
