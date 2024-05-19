<?php

use App\Models\Wishlist;
use App\Models\StoreBook;
use App\Models\CategoryBlog;
use App\Models\CategoryBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Stevebauman\Location\Facades\Location;
use App\Http\Controllers\Api\V1\FqaController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\QuizController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\Api\V1\CouponController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\RatingController;
use App\Http\Controllers\Api\V1\CommentsController;
use App\Http\Controllers\Api\V1\PaymentsController;
use App\Http\Controllers\Api\V1\SetttingController;
use App\Http\Controllers\Api\V1\WishlistController;
use App\Http\Controllers\Api\V1\ContentUsController;
use App\Http\Controllers\Api\V1\CountriesController;
use App\Http\Controllers\Api\V1\StoreBookController;
use App\Http\Controllers\Api\V1\FreeCourseController;
use App\Http\Controllers\Api\V1\ResultQuizController;
use App\Http\Controllers\Api\V1\UsersGradesController;
use App\Http\Controllers\Api\V1\CategoryBlogController;
use App\Http\Controllers\Api\V1\CategoryBookController;
use App\Http\Controllers\Api\V1\CategoryQuizController;
use App\Http\Controllers\Api\V1\CollectPointsController;
use App\Http\Controllers\Api\V1\NotificationsController;
use App\Http\Controllers\Api\V1\StudyScheduleController;
use App\Http\Controllers\Api\V1\CategoryCourseController;
use App\Http\Controllers\Api\V1\CategoryGradesController;
use App\Http\Controllers\Api\V1\CourseEnrolledController;
use App\Http\Controllers\Api\V1\PaymentsOnlineController;
use App\Http\Controllers\Api\V1\CategoryFreeCourseController;



Route::post('/new/study_schedule', [StudyScheduleController::class, 'create_study_schedule'])->name('create_study_schedule');
Route::get('/category/free/course', [CategoryFreeCourseController::class, 'getcategoryfreecourse']);
Route::get('/category/grades', [CategoryGradesController::class, 'get_category']);
Route::get('/grades/bycategoryid/{id?}', [UsersGradesController::class, 'get_grades_by_category']);
Route::post('/quiz/send/answers', [ResultQuizController::class, 'send_answers']);
Route::get('/quiz', [QuizController::class, 'get_quiz_by_id']);
Route::get('/quiz/bycategory', [QuizController::class, 'get_quiz_by_category']);
Route::get('/category/books', [CategoryBookController::class, 'get_category_book']);
Route::get('/category/blog', [CategoryBlogController::class, 'get_category_blog']);
Route::get('/blog/by/category', [BlogController::class, 'get_blog_by_category']);
Route::get('/blog', [BlogController::class, 'get_blog_by_id']);
Route::get('/category/quiz', [CategoryQuizController::class, 'get_category_quiz']);
Route::post('/content_us', [ContentUsController::class, 'send_contentus']);
Route::get('/fqa', [FqaController::class, 'get_fqa']);

Route::controller(UsersController::class)->group(function () {
    Route::any('/login',  'login')->name('login'); //post
    Route::any('/sendotp',  'sendotp'); //post
    Route::any('/signup',  'signup'); //post
    Route::any('/forgotpassword',  'forgotpassword'); //post
    Route::any('/verificationcode',  'verificationcode'); //post
    Route::any('/change-password',  'change_password'); //post
    Route::any('/resend-code',  'resend_code'); //post
    Route::get('/verificationcode/{code?}', 'verificationcode')->name('signup');
    Route::get('/teamwork',  'get_teamwork');
});

Route::controller(CategoryCourseController::class)->group(function () {
    Route::get('/category_course', 'getcategorycourse')->name('getcategorycourse');
    Route::get('/home_category_course', 'gethomecategorycourse')->name('gethomecategorycourse');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/courses/{category_id}', 'getcoursesbycategroy')->name('getcoursesbycategroy');
    Route::get('/course/not_subscribed/{id}', 'getcoursebyidnot_subscribed');
});

Route::controller(FreeCourseController::class)->group(function () {
    Route::get('/free/course/bycategory/{id?}', 'get_free_course_by_category');
    Route::get('/free/course/{id?}', 'get_free_course_by_id');
});

Route::controller(CountriesController::class)->group(function () {
    Route::get('/countries', 'get_countries');
    Route::get('/test', 'get_test');
});

Route::controller(StoreBookController::class)->group(function () {
    Route::get('/books/bycategory/{id?}',  'get_books_by_category');
    Route::get('/book',  'get_book_by_id');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/home',  'homep')->name('homep');
    Route::get('/home/section1',  'section1')->name('section1');
    Route::get('/slider',  'getslider')->name('getslider');
    Route::get('/setting',  'getsetting')->name('getsetting');
    Route::get('/privacy', 'get_privacy');
    Route::get('/terms_and_conditions', 'get_terms_and_conditions');
    Route::get('/about_us', 'get_about_us');
    Route::get('/say_about_us', 'get_say_about_us');
});

Route::get('/get_payment', [PaymentsController::class, 'get_payment']);

Route::controller(CourseController::class)->group(function () {
    Route::get('/course/subscribe/{id}', 'getcoursebyidsubscripe2')->name('getcoursebyid');
    Route::get('/calculating-progress-rate', 'get_calc_prog2');
    // Route::get('/calculating-progress-rate2', 'get_calc_prog2');
});
Route::middleware(['jwt.verify', 'cors'])->group(function () {
    Route::controller(NotificationsController::class)->group(function () {
        Route::get('/notifications', 'get_notifications');
        Route::get('/read/notifications', 'read_notifications');
    });

    Route::controller(CartController::class)->group(function () {
        Route::get('/cart/add/book', 'addtocart');
        Route::get('/cart/delete/book', 'deletefromcart');
        Route::get('/cart/get', 'getcart');
    });
    Route::controller(CourseController::class)->group(function () {
        // Route::get('/course/subscribe/{id}', 'getcoursebyidsubscripe2')->name('getcoursebyid');
        // Route::get('/calculating-progress-rate', 'get_calc_prog2');
        // Route::get('/calculating-progress-rate2', 'get_calc_prog2');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/my-orders',  'get_myorders');
        Route::post('/please-order',  'please_order');
    });
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist/add/book', 'add_to_wishlist');
        Route::get('/wishlist/delete/book', 'delete_from_wishlist');
        Route::get('/wishlist/get', 'get_wishlist');
    });
    Route::controller(CommentsController::class)->group(function () {
        Route::post('/add/comment/course', 'add_comment_course');
        Route::post('/add/comment/freecourse', 'add_comment_freecourse');
    });
    Route::controller(UsersController::class)->group(function () {
        Route::any('/update/profile', 'profile_update'); //post
        Route::any('/details/profile', 'profile_details'); //post
    });
    Route::controller(RatingController::class)->group(function () {
        Route::get('/get_rating_course', 'get_rating_course');
        Route::Post('/send_rating', 'send_rating');
    });
    Route::controller(CourseEnrolledController::class)->group(function () {
        Route::get('/course/mycourse', 'get_my_course');
        Route::get('/course/category/mycourse', 'get_category_my_course');
    });
    Route::get('/convert-points', [CollectPointsController::class, 'convert_points']);
    Route::get('/checkcoupon', [CouponController::class, 'checkcoupon']);
});

Route::get('/cc', function (Request $request) {

    $apiToken = 'BElaIrqq5MSOviLKCXb8J3vXR9FyPxxtAEIK9KAP0037ed33';
    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'https://waapi.app/api/v1/instances', [
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer BElaIrqq5MSOviLKCXb8J3vXR9FyPxxtAEIK9KAP0037ed33',
        ],
    ]);

    return $response->getBody();
    // 'O0VXzpumfxComubXLubUo6Yk9dDCg3UH';
    // return $ownerEmail ;
    // return     json_decode( json_encode(Location::get($request->ip())), true);
});
Route::get('/wts', function (Request $request) {

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
