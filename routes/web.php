<?php


use Goutte\Client;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Courses;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryFCourse;
use Vimeo\Laravel\VimeoManager;
use App\Livewire\Dashboard\Test;
use App\Livewire\ScripingCourse;
use App\Models\QuizResultHeader;
use Vimeo\Laravel\Facades\Vimeo;
use App\Models\QuizResultDetails;
use App\Models\Stages as mstages;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Livewire\Dashboard\Stage\Stages;
use App\Livewire\Dashboard\Blog\ViewBlog;
use Symfony\Component\DomCrawler\Crawler;

use App\Livewire\Dashboard\Setting\Slider;
use Stevebauman\Location\Facades\Location;
use App\Livewire\Dashboard\Books\ViewBooks;
use App\Livewire\Dashboard\Quizzes\Newquiz;
use App\Livewire\Dashboard\Order\ViewOrders;
use App\Livewire\Dashboard\Quizzes\Newquiz2;
use App\Livewire\Dashboard\Vimeo\Filemanger;
use App\Http\Controllers\NewCourseController;
use App\Livewire\Dashboard\Courses\NewCourse;
use App\Livewire\Dashboard\Grades\ViewGrades;
use App\Livewire\Dashboard\Quizzes\ViewQuizz;
use App\Livewire\Dashboard\Trainees\Trainees;
use App\Livewire\Dashboard\Trainers\Trainers;
use App\Livewire\Dashboard\Courses\EditCourse;
use App\Livewire\Dashboard\Order\DetailsOrder;
use App\Livewire\Dashboard\Courses\ViewCourses;
use App\Livewire\Dashboard\ContactUs\ViewContact;
use App\Livewire\Dashboard\FreeCourse\FreeCourse;
use App\Livewire\Dashboard\Blog\Category\CategoryBlog;
use App\Livewire\Dashboard\Payments\ViewPaymentsMethod;

use App\Livewire\Dashboard\Books\Category\CategoryBooks;
use App\Livewire\Dashboard\Notification\ViewNotification;
use App\Livewire\Dashboard\Grades\Category\CategoryGrades;
use App\Livewire\Dashboard\Trainers\Specialist\Specialist;
use App\Livewire\Dashboard\Courses\Category\CategoryCourse;
use App\Livewire\Dashboard\StudySchedule\ViewStudySchedule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Livewire\Dashboard\Setting\Setting as SettingSetting;
use App\Livewire\Dashboard\Quizzes\QuizCategory\ViewQuizCategory;
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
Route::get('/script', function (Request $request) {
    function vurl($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['host']) && $parsedUrl['host'] === 'player.vimeo.com' && isset($parsedUrl['path'])) {
            preg_match('/\/video\/(\d+)/', $parsedUrl['path'], $matches);
            if (isset($matches[1])) {
                $videoId = $matches[1];
                return "https://vimeo.com/{$videoId}";
            }
        }
    }
    //     $client = new Client();
    //     // $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_SSL_VERIFYHOST, FALSE);
    //     // $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_SSL_VERIFYPEER, FALSE);
    // $website = $client->request('GET', 'https://albaraah.sa/courses/%D9%82%D8%AF%D8%B1%D8%A7%D8%AA-%D9%85%D8%AD%D9%88%D8%B3%D8%A8-219-%D8%B7%D9%84%D8%A7%D8%A8');

    $client = new Client();

    $website = $client->request('GET', $request->url);
    $website->filter('.container')->each(function ($container) use (&$data) {
        $container->children()->each(function ($container_child) use (&$data) {
            $container_child->filter('.image-content')->each(function ($image_conten) use (&$data) {
                $image_conten->children()->each(function ($child) use (&$data) {
                    $data['image'] = $child->attr('src');
                });
            });
            $container_child->filter('.content')->each(function ($content) use (&$data) {
                $data['title']         = $content->children()->first()->text();
                $data['category_name'] = $content->children('a')->first()->text();
                $price             = $content->children('.data-price')->children('.price')->children('h6')->text();
                $data['price']     = preg_replace('/[^0-9]/', '', $price);
                $data['price_text']  = $content->children('.data-price')->children('.price')->eq(0)->children('p')->text() ?? '';
                // $priceprint        = ($content->children('.data-price')->children('.price')->eq(1)->children('h6')->text())??'';
                // $data['price_print']     = preg_replace('/[^0-9]/', '',$priceprint ??'');
                // $data['price_print_text']  = $content->children('.data-price')->children('.price')->eq(1)->children('p')->text();
                $data['currency']  = trim(preg_replace('/[0-9]+/', '', $price)); // Removes numbers
                $data['validity']  = $content->children('.mt-2')->children('.col-md-6')->eq(1)->children('div')->text();
                $data['duration']  =  $content->children('.mt-2')->children('.col-md-6')->eq(0)->children('div')->text();
                $data['short_description']  =  $content->children('div')->eq(2)->text();
            });
            $container_child->filter('.tab-content')->each(function ($tabs) use (&$data) {
                $tabs->children()->each(function ($child) use (&$data) {
                    if ($child->attr('id') == 'pills-home') {
                        $data['features'] = str_replace("\n", '',   $child->html());
                    }
                    if ($child->attr('id') == 'pills-profile') {
                        $data['conditions'] = str_replace("\n", '',  $child->html());
                    }
                    if ($child->attr('id') == 'pills-brief') {

                        $data['description'] =    str_replace("\n", '',  $child->html());
                    }
                });
            });
        });
    });

    // $crawler = $client->request('GET', 'https://albaraah.sa/login/');
    // $form = $crawler->selectButton('wp-submit')->form();
    // $form['log'] = '563517768';
    // $form['pwd'] = 'Zxcv@1234@Zxcv';
    // $client->submit($form);
    // $website_login = $client->request('GET', $request->url);
    // $url = $request->url;
    // $website_login->filter('.courseViewBox')->each(function ($courseViewBox) use (&$data, &$url, &$client) {
    //     $courseViewBox->filter('.courseDetails')->each(function ($courseDetails) use (&$data) {
    //         $data['target'] = $courseDetails->filter('#courseAccordion')->filter('#collapseOne')->filter('.mb-4')->text();
    //         $courseDetails->filter('#courseAccordion')->filter('#collapseTwo')->filter('.mb-4')->children('ul')->children('li')->each(function ($collapsetwo, $index) use (&$data) {
    //             $data['triners'][$index]['telegram'] = $collapsetwo->children('a')->attr('href');
    //             $data['triners'][$index]['name'] = $collapsetwo->children('a')->text();
    //         });
    //         $courseDetails->filter('.detailsBlock')->each(function ($detailsBlock, $index) use (&$data) {
    //             $data['files'][$index]['link'] = $detailsBlock->filter('a')->attr('href');
    //             $data['files'][$index]['name'] = $detailsBlock->filter('a')->text();
    //         });
    //     });
    //     $courseViewBox->filter('.courseListBody')->each(function ($detailsBlock, $index) use (&$data, &$url, &$client) {
    //         $detailsBlock->children('.listItem')->each(function ($listItem, $index) use (&$data, &$url,  &$client) {
    //             $name = $listItem->children('.listItemHead')->text();
    //             $data['stage'][$index]['name'] = $name;
    //             $currentCategory = null;

    //             $listItem->children('.listItemBody')->each(function ($listItemBody) use (&$data, $index, &$currentCategory, &$url,  &$client) {
    //                 $classes = $listItemBody->attr('class');
    //                 if (strpos($classes, 'lessonCategory') !== false) {
    //                     $currentCategory = $listItemBody->text();
    //                     $data['stage'][$index]['chiled'][$currentCategory] = [];
    //                 } elseif ($currentCategory) {
    //                     // Only process if we have a current category
    //                     $listItemBody->filter('.listLesson')->each(function ($listLesson, $index2) use (&$data, $index, &$currentCategory, $listItemBody, &$url, &$client) {
    //                         $lessonName = trim($listLesson->text());
    //                         $lessonLink = $listLesson->filter('a.specialclass')->attr('href');
    //                         $classes = $listItemBody->attr('class');
    //                         $website_login = $client->request('GET', $url . $lessonLink);
    //                         if (strpos($classes, 'is_test_class') !== false) {
    //                             $testName = trim($listItemBody->filter('a.specialclass')->eq(1)->text());
    //                             $testLink = $listItemBody->filter('a.specialclass')->eq(1)->attr('href');
    //                             // dd($url . $testLink);


    //                             $data['stage'][$index]['chiled'][$currentCategory][] = ['is_lesson' => 0, 'name' => $testName, 'link' => $testLink,'link_v' =>  ''];
    //                             $data['stage'][$index]['chiled'][$currentCategory][] = ['is_lesson' => 1, 'name' => $lessonName, 'link' => $lessonLink ,'link_v' =>  $website_login->filter('iframe')->eq(1)->attr('src')];
    //                         } else {

    //                             $data['stage'][$index]['chiled'][$currentCategory][] = ['is_lesson' => 1, 'name' => $lessonName, 'link' => $lessonLink, 'link_v' =>  $website_login->filter('iframe')->eq(1)->attr('src')];
    //                         }
    //                     });
    //                 }
    //             });
    //         });
    //     });

    //     // $listItem->each(function ($listItemHead, $index1) use (&$data, $index, $listItem) {
    //     //     $listItemHead->children('.lessonCategory')->each(function ($lessonCategory, $index1) use (&$data, $index, $listItem, $listItemHead) {
    //     //         $data['stage'][$index]['chiled'][$index1]['name']  = $lessonCategory->text();


    //     //         $classes = $listItem->attr('class');

    //     //         // Check if the class attribute contains 'lessonCategory'
    //     //         if (strpos($classes, 'lessonCategory') !== false) {

    //     //             dump($lessonCategory->text());
    //     //         }

    //     //         $listItem->filter('.listLesson')->each(function ($listLesson, $index2) use (&$data, $index, $index1, $listItem, $listItemHead, $lessonCategory) {
    //     //             // $x  = $listLesson->nextAll()->filter('.lessonCategory')->first();

    //     //             $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['name'] = $lessonCategory->text() . '  -  ' . $listLesson->text();
    //     //             // $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['name'] =  $listLesson->text();
    //     //             // $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['link'] =  $listLesson->filter('a')->attr('href');

    //     //         });



    //     //         // $listItem->filter('.listLesson')->each(function ($listLesson, $index2) use (&$data, $index,$index1) {
    //     //         //     $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['name'] =  $listLesson->text();
    //     //         //     $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['link'] =  $listLesson->filter('a')->attr('href');
    //     //         // });
    //     //     });
    //     //     // $listItemHead->children('.listItemBody')->each(function ($lessonCategory, $index1) use (&$data, $index, $listItem) {
    //     //     //     // dump($lessonCategory->html());
    //     //     //     $data['stage'][$index]['chiled'][$index1]['name']  = $lessonCategory->text();
    //     //     //     // $data['stage'][$index]['chiled'][$index1]['Lesson'] =  [$listLesson->text()];
    //     //     //     $lessonCategory->children('.listLesson')->each(function ($listLesson, $index2) use (&$data, $index, $index1) {
    //     //     //         $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['name'] =  $listLesson->text();
    //     //     //         $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['link'] =  $listLesson->filter('a')->attr('href');
    //     //     //     });
    //     //     // });
    //     // });


    // });
    return $data;
    return  'not found';
});
Route::get('/ncc', function (Request $request) {

    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return Artisan::output();
});

Route::get('/test', function (Request $request) {
    $p1 =   public_path('files' . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR . '533e4944-29a0-4be7-b81c-9b48c54e4b64' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'Fyol1715638937.jpg');

    // $p1 = public_path('\files\courses\533e4944-29a0-4be7-b81c-9b48c54e4b64\images\Fyol1715638937.jpg');
    $p2 = public_path('\files\ranout.png');


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

    $watermark = Image::make($p2);
    // $watermark->rotate(45);

    $watermark->resize(300, 300);
    $image = Image::make($p1);
    // $image->blur(18);
    $image->greyscale();

    $imageWidth = $image->width();
    $imageHeight = $image->height();
    $positionX = ($imageWidth - $watermark->width()) / 2;
    $positionY = ($imageHeight - $watermark->height()) / 2;
    $image->insert($watermark, 'center',  number_format($positionX),  number_format($positionY));
    // $image->insert($watermark, 'center');
    // return $image->response('jpg');
    $filename = 'processed_image.jpg'; // You can generate a unique filename if needed
    $path = 'files/' . $filename;

    // Save the image to the public storage
    $image->save(public_path($path));

    // Generate the URL to the saved image
    $imageUrl = url($path);

    return $imageUrl;
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        // Livewire::setUpdateRoute(function ($handle) {
        //         return Route::post('/livewire/update', $handle);
        //     });
        Route::get('/', function () {

            return view('layouts.dashboard.app');
        });
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
