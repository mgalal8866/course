<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewCourseController;
use App\Http\Controllers\QizeController;
use App\Http\Controllers\QRCodeController;
use App\Livewire\Dashboard\Blog\Category\CategoryBlog;
use App\Livewire\Dashboard\Blog\EditBlog;
use App\Livewire\Dashboard\Blog\ViewBlog;
use App\Livewire\Dashboard\Books\Category\CategoryBooks;
use App\Livewire\Dashboard\Books\ViewBooks;
use App\Livewire\Dashboard\ContactUs\ViewContact;
use App\Livewire\Dashboard\Courses\Category\CategoryCourse;
use App\Livewire\Dashboard\Courses\EditCourse;
use App\Livewire\Dashboard\Courses\NewCourse;
use App\Livewire\Dashboard\Courses\ViewCourses;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\FreeCourse\Category\CategoryFreeCourse;

use App\Livewire\Dashboard\FreeCourse\FreeCourse;
use App\Livewire\Dashboard\Grades\Category\CategoryGrades;
use App\Livewire\Dashboard\Grades\ViewGrades;
use App\Livewire\Dashboard\Notification\ViewNotification;
use App\Livewire\Dashboard\Order\DetailsOrder;
use App\Livewire\Dashboard\Order\ViewOrders;
use App\Livewire\Dashboard\Payments\ViewPaymentsMethod;
use App\Livewire\Dashboard\Quizzes\Newquiz2;
use App\Livewire\Dashboard\Quizzes\Newquiz;
use App\Livewire\Dashboard\Quizzes\QuizCategory\ViewQuizCategory;
use App\Livewire\Dashboard\Quizzes\ViewQuizz;
use App\Livewire\Dashboard\Setting\Setting as SettingSetting;
use App\Livewire\Dashboard\Setting\Slider;
use App\Livewire\Dashboard\Stage\Stages;
use App\Livewire\Dashboard\StudySchedule\ViewStudySchedule;
use App\Livewire\Dashboard\Test;
use App\Livewire\Dashboard\Trainees\Trainees;
use App\Livewire\Dashboard\Trainers\Specialist\Specialist;
use App\Livewire\Dashboard\Trainers\Trainers;
use App\Livewire\Dashboard\Vimeo\Filemanger;

use App\Livewire\ScripingCourse;
use App\Livewire\Testckeditor;
use App\Models\Admin;
use App\Models\QuizResultDetails;
use App\Models\QuizResultHeader;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Stevebauman\Location\Facades\Location;
use Vimeo\Laravel\Facades\Vimeo;
use Barryvdh\DomPDF\Facade as PDF;



Route::post('/upload-image', [ImageController::class, 'uploadImage']);


Route::get('/testck', function (Request $request) {
    return  view('testckeditorblade');
});
Route::get('/', function (Request $request) {
    return  view('soon');
});
Route::get('/clear', function (Request $request) {
    QuizResultHeader::truncate();
    QuizResultDetails::truncate();
    return 'Done';
    // Artisan::call('optimize');
    // return Artisan::output();
});
Route::get('/cache', function (Request $request) {


    Artisan::call('optimize');
    Artisan::call('view:cache');
    Artisan::call('route:trans:cache');
    return Artisan::output();
});

Route::get('/ncc', function (Request $request) {

    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return Artisan::output();
});
Route::get('/webhook', function (Request $request) {

    Log::error( $request->all());
});

Route::get('/reeees', function (Request $request) {


    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer d83a5d07aaeb8442dcbe259e6dae80a3f2e21a3a581e1a5acd',
    ])->post('https://staging.fawaterk.com/api/v2/invoiceInitPay', [
        'payment_method_id' => 2,
        'cartTotal' => '50',
        'currency' => 'EGP',
        'invoice_number' => '123',
        'customer' => [
            'first_name' => 'mohammad',
            'last_name' => 'hamza',
            'email' => 'test@fawaterk.com',
            'phone' => '01024346011',
            'address' => 'test address',
        ],
        'redirectionUrls' => [
            'successUrl' => 'https://api.alyusr.academy/Cart/ConfirmPayment?status=success',
            'failUrl' => 'https://api.alyusr.academy/Cart/ConfirmPayment?status=fail',
            'pendingUrl' => 'https://api.alyusr.academy/Cart/ConfirmPayment?status=pending',
        ],
        'cartItems' => [
            [
                'name' => 'this is test oop 112252',
                'price' => '25',
                'quantity' => '1',
            ],
            [
                'name' => 'this is test oop 112252',
                'price' => '25',
                'quantity' => '1',
            ],
        ],
    ]);

    // To get the response body
    $responseBody = $response->body();

    // To get the response data as an array (if the response is JSON)
    return   $response->json();

});

Route::get('/test', function (Request $request) {
   return Admin::create(['username'=>'admin@admin.com','password'=>'admin']);
    // $gg = Setting::where('key', 'api_token_chat')->value('value');
    // $url = 'https://api.openai.com/v1/chat/completions';
    // $response = Http::withHeaders([
    //     'Content-Type' => "application/json",
    //     'Authorization' => "Bearer " . $gg,
    // ])->post($url, [
    //     'model' => "gpt-3.5-turbo",
    //     'messages' => [
    //         ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //         // ['role' => 'user', 'content' => 'this is blog post title:'.PHP_EOL.'help pepole'.PHP_EOL. 'Improve it for SEO and provide 6 alterntive titles to lang arabic'],
    //         ['role' => 'user', 'content' => 'Translate the following English text to arabic: "' . $request->text . '"'],
    //     ],
    //     'temperature' => 0,
    //     'max_tokens' => 3900,
    // ]);
    // $rr =  $response->json();
    // // $ar =    array_slice(preg_split('/\r\n|\r|\n/', $rr['choices'][0]['message']['content']), -5, 5);
    // // dd ($rr['choices'][0]['message']['content']);
    // dd($rr);

    // // Session::put('token', 'asdasdasd');
    // // Cache::Forever('token', 'asdasdasd');
    // // return app('getSettings');

    // // return   Browser::browserName() .' - '.Browser::platformName() .' - '.$request->ip() .' - ' .   json_decode( json_encode(Location::get($request->ip())), true);
    // return    json_decode(json_encode(Location::get($request->ip())), true);


});
Route::get('/generate-qrcode', [QRCodeController::class, 'generateQRCode']);
Route::post('/add-group', [QRCodeController::class, 'addGroup']);

Route::get('qr/{code}',[ QRCodeController::class,'qr_redirect']);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'middleware' => ['auth:admin','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::post('/generate-pdf',[QrCodeController::class, 'generate_pdf'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
        Route::get('qr_mangement',[ QRCodeController::class,'qr_mangement'])->name('qr_mangement');
        Route::post('/qr-codes', [QrCodeController::class, 'store'])->name('qr-codes.store');

        Route::put('qr-codes/{qr}',[ QRCodeController::class,'update_qr']);
        Route::get('testck', Testckeditor::class);
        // Livewire::setUpdateRoute(function ($handle) {
        //         return Route::post('/livewire/update', $handle);
        //     });
        Route::get('/',  Dashboard::class);
        Route::get('/test21', function (Request $request) {

            $pageCount = 5; // عدد صفحات الكتاب
            $pagesPerDay = ceil($pageCount / 6); // توزيع الصفحات على 6 أيام
            $distribution = [];
            $distributedPages = 0;

            // مصفوفة لتتبع الصفحات التي تم توزيعها في كل يوم
            $distributedPagesInDay = [];

            for ($day = 1; $day <= 6; $day++) {
                // التأكد من أننا لم نوزع الصفحات في هذا اليوم بالفعل
                if (!isset($distributedPagesInDay[$day])) {
                    $startPage = $distributedPages + 1;
                    $endPage = min($startPage + $pagesPerDay - 1, $pageCount);
                    $distribution[] = "Day $day: Pages $startPage-$endPage";

                    // تحديث عدد الصفحات الموزعة حتى الآن
                    $distributedPages += $endPage - $startPage + 1;

                    // إضافة اليوم إلى قائمة الأيام التي تم توزيع الصفحات عليها
                    $distributedPagesInDay[$day] = range($startPage, $endPage);
                }
            }

            // عودة لوضع الكتب المتبقية
            // $pageCount = 16 - $distributedPages;
            // $pagesPerDay = ceil($pageCount / (6 - count($distributedPagesInDay)));

            // for ($day = 1; $day <= 6; $day++) {
            //     // التأكد من أننا لم نوزع الصفحات في هذا اليوم بالفعل
            //     if (!isset($distributedPagesInDay[$day])) {
            //         $startPage = $distributedPages + 1;
            //         $endPage = min($startPage + $pagesPerDay - 1, $pageCount);
            //         $distribution[] = "Day $day: Pages $startPage-$endPage";

            //         // تحديث عدد الصفحات الموزعة حتى الآن
            //         $distributedPages += $endPage - $startPage + 1;

            //         // إضافة اليوم إلى قائمة الأيام التي تم توزيع الصفحات عليها
            //         $distributedPagesInDay[$day] = range($startPage, $endPage);
            //     }
            // }


            return implode("\n", $distribution) . "\n";


            // // $dd =   Vimeo::request('/users/213717808/projects/19542970 ', null, 'GET');
            $dd =   Vimeo::request('/users/213717808/folders', null, 'GET');
            //  $dd =  Vimeo::request( '/users/213717808/folders' ,[
            //     'name' => 'subFolderName',
            //     "parent_folder_uri"=> "/users/213717808/projects/19543138"
            // ], 'POST');
            // $data =  $dd['body']['data'];
            $data =  $dd['body']['data'];
            // return $data;
            return view('viemo', compact('data'));
        });
        Route::get('/test2', function (Request $request) {
            $phone = '201024346011';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v15.0/231471670042677/messages',
                // CURLOPT_URL => 'https://graph.facebook.com/v15.0/192748520596240/message_templates',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',

                CURLOPT_POSTFIELDS => '{
                "messaging_product": "whatsapp",
                "recipient_type": "individual",
                "to": ' . $phone . ',
                "type": "template",
                "template": {
                    "name": "ottttp",
                    "language": {
                        "code": "ar"
                    },
                    "components": [
                        {
                          "type": "body",
                          "parameters": [
                            {
                              "type": "text",
                              "text": ' . $phone . '
                            }
                          ]
                        }
                    ],
                    },
                }
                  ',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer EAAZAPwzlXEZAoBO84FZALRI4TNj6rJItJrgGv7GWnKm7vHPR1t89R5wKfnC7fVppRhgfRBUXWdg0yZBdJs2IaR3bGtdj8BUwGuC7ZA6ShzYuH8E462BExNopd3e3NR4E9CtCjJ2nf4ysYgqgbRqvheGPEOiHymFCF1il8mUEuBahaSMwDtM55oESbCz9K5vShsIeXmIHrJ3W98RReDR0ZD',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            echo $response;
        });
        Route::get('/test1', Test::class);
        // Route::get('/test1', NewCourse::class)->name('newcourse');



        Route::get('/question/{id?}', [QizeController::class,'getquestion'])->name('viewquestion');
        Route::get('/question/delete/{id?}', [QizeController::class,'deletequestion'])->name('deletequestion');
        Route::get('/question/model/{id?}/{quiz?}', [QizeController::class,'getModal'])->name('get-modal');
        Route::get('/quiz/model/{quiz?}', [QizeController::class,'get_edit_quiz_Modal'])->name('get_edit_quiz_Modal');
        Route::post('/save_edit_quiz_Modal', [QizeController::class,'save_edit_quiz_Modal'])->name('save_edit_quiz_Modal');
        Route::post('/save-modal-data', [QizeController::class, 'saveModalData'])->name('save-modal-data');

        Route::get('/vimeo', Filemanger::class);
        Route::get('/scrip/course', ScripingCourse::class)->name('scripcourse');
        Route::get('/new/course', NewCourse::class)->name('newcourse');


        Route::get('/new/course/step/2', [NewCourseController::class, 'index'])->name('newcourse2');
        Route::post('/ajax/next/page', [NewCourseController::class, 'next_page'])->name('next_page');
        Route::get('/ajax/getcategory/{id?}', [NewCourseController::class, 'getcategory'])->name('getcategory');
        Route::post('/formsub', [NewCourseController::class, 'save_course'])->name('save_course');

        Route::get('/edit/course/{id?}', EditCourse::class)->name('editcourse');
        Route::get('/course', ViewCourses::class)->name('course');
        Route::get('/free-course', FreeCourse::class)->name('freecourse');
        Route::get('/category/free-course', CategoryFreeCourse::class)->name('categoryfree');
        Route::get('/category/courses', CategoryCourse::class)->name('category');
        Route::get('/category/quiz', ViewQuizCategory::class)->name('category-quiz');
        Route::get('/notification', ViewNotification::class)->name('notification');
        // Route::get('/new/quiz', Newquiz::class)->name('newquiz');
        Route::get('/new/quiz2', Newquiz2::class)->name('newquiz');
        Route::get('/view/quiz', ViewQuizz::class)->name('viewquiz');
        Route::get('/trainers', Trainers::class)->name('trainers');
        Route::get('/trainees', Trainees::class)->name('trainees');
        Route::get('/contact-us', ViewContact::class)->name('contactus');
        Route::get('/specialist', Specialist::class)->name('specialist');
        Route::get('/blog', ViewBlog::class)->name('blog');
        Route::get('/blog/edit/{id?}', EditBlog::class)->name('editblog');
        Route::get('/category/blog', CategoryBlog::class)->name('category-blog');
        Route::get('/payment-method', ViewPaymentsMethod::class)->name('payment-method');
        Route::get('/setting', SettingSetting::class)->name('setting');
        Route::get('/slider', Slider::class)->name('slider');
        Route::get('/order', ViewOrders::class)->name('order');
        Route::get('/details/order/{id?}', DetailsOrder::class)->name('detailsorder');
        Route::get('/stage', Stages::class)->name('stage');
        Route::get('/grades', ViewGrades::class)->name('viewgrades');
        Route::get('/grades/category', CategoryGrades::class)->name('categorygrades');
        Route::get('/books/category', CategoryBooks::class)->name('categorybooks');
        Route::get('/books', ViewBooks::class)->name('viewbooks');
        Route::get('/studyschedule', ViewStudySchedule::class)->name('studyschedule');
    }
);

Auth::routes();

