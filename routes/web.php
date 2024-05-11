<?php


use Goutte\Client;
use Livewire\Livewire;
use App\Models\Courses;
use App\Models\Setting;
use Illuminate\Http\Request;
use Vimeo\Laravel\VimeoManager;
use App\Livewire\Dashboard\Test;
use App\Models\QuizResultHeader;
use Vimeo\Laravel\Facades\Vimeo;
use App\Models\QuizResultDetails;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Artisan;
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

    //     $client = new Client();
    //     // $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_SSL_VERIFYHOST, FALSE);
    //     // $client->getClient()->setDefaultOption('config/curl/'.CURLOPT_SSL_VERIFYPEER, FALSE);
    // $website = $client->request('GET', 'https://albaraah.sa/courses/%D9%82%D8%AF%D8%B1%D8%A7%D8%AA-%D9%85%D8%AD%D9%88%D8%B3%D8%A8-219-%D8%B7%D9%84%D8%A7%D8%A8');
    //
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
                        $data['features'] = $child->html();
                    }
                    if ($child->attr('id') == 'pills-profile') {
                        $data['conditions'] = $child->html();
                    }
                    if ($child->attr('id') == 'pills-brief') {
                        $data['description'] = $child->html();
                    }
                });
            });
        });
    });

    $crawler = $client->request('GET', 'https://albaraah.sa/login/');
    $form = $crawler->selectButton('wp-submit')->form();
    $form['log'] = '563517768';
    $form['pwd'] = 'Zxcv@1234@Zxcv';
    $client->submit($form);
    $website_login = $client->request('GET', $request->url);

    $website_login->filter('.courseViewBox')->each(function ($courseViewBox) use (&$data) {
        $courseViewBox->filter('.courseDetails')->each(function ($courseDetails) use (&$data) {
            $data['target'] = $courseDetails->filter('#courseAccordion')->filter('#collapseOne')->filter('.mb-4')->text();
            $courseDetails->filter('#courseAccordion')->filter('#collapseTwo')->filter('.mb-4')->children('ul')->children('li')->each(function ($collapsetwo, $index) use (&$data) {
                $data['triners'][$index]['telegram'] = $collapsetwo->children('a')->attr('href');
                $data['triners'][$index]['name'] = $collapsetwo->children('a')->text();
            });
            $courseDetails->filter('.detailsBlock')->each(function ($detailsBlock, $index) use (&$data) {
                $data['files'][$index]['link'] = $detailsBlock->filter('a')->attr('href');
                $data['files'][$index]['name'] = $detailsBlock->filter('a')->text();
            });
        });
        $courseViewBox->filter('.courseListBody')->each(function ($detailsBlock, $index) use (&$data) {
            $detailsBlock->children('.listItem')->each(function ($listItem, $index) use (&$data) {
                $data['stage'][$index]['name'] = $listItem->children('.listItemHead')->text();
                $listItem->each(function ($listItemHead, $index1) use (&$data, $index, $listItem) {

                    // $listItemHead->children('.lessonCategory')->each(function ($lessonCategory, $index1) use (&$data, $index, $listItem) {
                    //     $data['stage'][$index]['chiled'][$index1]['name']  = $lessonCategory->text();

                    //     $listItem->filter('.listLesson')->each(function ($listLesson, $index2) use (&$data, $index,$index1) {
                    //         $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['name'] =  $listLesson->text();
                    //         $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['link'] =  $listLesson->filter('a')->attr('href');
                    //     });
                    // });
                    $listItemHead->children('.listItemBody')->each(function ($lessonCategory, $index1) use (&$data, $index, $listItem) {
// dump($lessonCategory->html());
                        $data['stage'][$index]['chiled'][$index1]['name']  = $lessonCategory->text();
                        // $data['stage'][$index]['chiled'][$index1]['Lesson'] =  [$listLesson->text()];
                        $lessonCategory->children('.listLesson')->each(function ($listLesson, $index2) use (&$data, $index,$index1) {
                            $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['name'] =  $listLesson->text();
                            $data['stage'][$index]['chiled'][$index1]['Lesson'][$index2]['link'] =  $listLesson->filter('a')->attr('href');
                        });
                    });
                });
            });
        });
    });
    return $data;
    return  'not found';
});
Route::get('/ncc', function (Request $request) {

    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return Artisan::output();
});
Route::get('/image1', function () {
    $accountid = "68eefd3c-a07b-4fdd-bb20-5102a75c3be7";
    $token = "eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1NmIzYjEwNzI0M2ViNjlhMDMxNjExZDVjNTI5MjBiZSIsInBlcm1pc3Npb25zIjpbXSwiYWNjZXNzUnVsZXMiOlt7ImlkIjoidHJhZGluZy1hY2NvdW50LW1hbmFnZW1lbnQtYXBpIiwibWV0aG9kcyI6WyJ0cmFkaW5nLWFjY291bnQtbWFuYWdlbWVudC1hcGk6cmVzdDpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciIsIndyaXRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoibWV0YWFwaS1yZXN0LWFwaSIsIm1ldGhvZHMiOlsibWV0YWFwaS1hcGk6cmVzdDpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciIsIndyaXRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoibWV0YWFwaS1ycGMtYXBpIiwibWV0aG9kcyI6WyJtZXRhYXBpLWFwaTp3czpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciIsIndyaXRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoibWV0YWFwaS1yZWFsLXRpbWUtc3RyZWFtaW5nLWFwaSIsIm1ldGhvZHMiOlsibWV0YWFwaS1hcGk6d3M6cHVibGljOio6KiJdLCJyb2xlcyI6WyJyZWFkZXIiLCJ3cml0ZXIiXSwicmVzb3VyY2VzIjpbIio6JFVTRVJfSUQkOioiXX0seyJpZCI6Im1ldGFzdGF0cy1hcGkiLCJtZXRob2RzIjpbIm1ldGFzdGF0cy1hcGk6cmVzdDpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoicmlzay1tYW5hZ2VtZW50LWFwaSIsIm1ldGhvZHMiOlsicmlzay1tYW5hZ2VtZW50LWFwaTpyZXN0OnB1YmxpYzoqOioiXSwicm9sZXMiOlsicmVhZGVyIiwid3JpdGVyIl0sInJlc291cmNlcyI6WyIqOiRVU0VSX0lEJDoqIl19LHsiaWQiOiJjb3B5ZmFjdG9yeS1hcGkiLCJtZXRob2RzIjpbImNvcHlmYWN0b3J5LWFwaTpyZXN0OnB1YmxpYzoqOioiXSwicm9sZXMiOlsicmVhZGVyIiwid3JpdGVyIl0sInJlc291cmNlcyI6WyIqOiRVU0VSX0lEJDoqIl19LHsiaWQiOiJtdC1tYW5hZ2VyLWFwaSIsIm1ldGhvZHMiOlsibXQtbWFuYWdlci1hcGk6cmVzdDpkZWFsaW5nOio6KiIsIm10LW1hbmFnZXItYXBpOnJlc3Q6cHVibGljOio6KiJdLCJyb2xlcyI6WyJyZWFkZXIiLCJ3cml0ZXIiXSwicmVzb3VyY2VzIjpbIio6JFVTRVJfSUQkOioiXX0seyJpZCI6ImJpbGxpbmctYXBpIiwibWV0aG9kcyI6WyJiaWxsaW5nLWFwaTpyZXN0OnB1YmxpYzoqOioiXSwicm9sZXMiOlsicmVhZGVyIl0sInJlc291cmNlcyI6WyIqOiRVU0VSX0lEJDoqIl19XSwidG9rZW5JZCI6IjIwMjEwMjEzIiwiaW1wZXJzb25hdGVkIjpmYWxzZSwicmVhbFVzZXJJZCI6IjU2YjNiMTA3MjQzZWI2OWEwMzE2MTFkNWM1MjkyMGJlIiwiaWF0IjoxNzEzMTA3ODE0fQ.k-JcNtL8nZKbJEVw8LgcN5dH1BHAc__UJZQAjQCsYCzG0R-J07DOHiwuJrkh03rV010TRV4bARyEZ1NEEIdMFfaESKgb2G1LikTSRt_ITQ_UJR4ZmUd2nyRd3Gcl8tCJDt-IG9F9aZ0FXPOvxO7znzIIgeLJXTowQJZpP870RtbckmUxEM3VGABqBiDYYavBLf8SaSX4DIDIuU9QKZuL7S98ZRbk9XPbnAiOUrdguYAT7fqsROzl9rE93HuuhIQW1hYByQLuxjN_xw7RsqbkMmMQyrezvgwk5ohJexrNO_RxqgBpihd1_oTaJodJ8wjrbv_2OsPXSOZjQ9eztn1bmpY1rA68jFqpYtG51zYrSY9_E09t8h-uojHUsZS53aA_jibLoztJS-pO8pa8cyWfizsErS8w2Nor6T7PB0Z1Co515BsKNUH_hfTf2hvk3BxWty-c6WuCWXgXVSJT0qyBBmtmqGoL_bFJQ_LPX7hZMDrI_tkBEqEKakAW7HIZntmxGR3kRv47OvctZKYxjizVJh-JoOLPbmG8wwB6zLArWP14N73OJc8EZWfJZe7TOjDtXjhUTGuHsO0BH0WjKqM-6MESEASxhV8bega5KpFIgxhtMO-eFy19-9ozqs5kksfnYxelC6E8Qr3HxPn6IwnmJJ13HJOcMUj-HGGXQZh4BlU";

    function funcurl($api, $requset, $token = null, $fields = '')
    {
        $curl = curl_init();
        $headers = [
            "Content-Type: application/json",
            "Accept: application/json",
        ];
        if ($token != null) {
            $headers[] = "auth-token: $token";
        }
        $options = [
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requset,
            CURLOPT_HTTPHEADER => $headers,
        ];

        if ($fields != null) {
            $options[CURLOPT_POSTFIELDS] = $fields;
        }

        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    $response = funcurl(
        "https://copyfactory-api-v1.new-york.agiliumtrade.ai/users/current/configuration/subscribers/$accountid",
        "GET",
        $token,
        null
    );

    $response =   json_decode($response, true);
    $response =  $response['subscriptions'][0]['symbolFilter']['included'];
    // $d = "EURJPY";
    // $response          = array_diff($response,  [". $d ."]);
    // if (count($response) == 0) {
    //     array_push($response, "");
    // }

    $convertedArray  = array_values($response);
    $includedSymbols = json_encode($convertedArray);
    dd($includedSymbols);

    // "["GBPJPY","GBPNZD","EURJPY"]" // routes\web.php:137
    ###############################################################
    ########################### SUBSCRIPE AND ADD SYMPOLY #########################
    ###############################################################
    $post_string =    '{
                "name": "",
            "copyStopLoss": true,  "copyTakeProfit": true,
                "subscriptions": [
                {      "strategyId": "CkFW",
                        "reduceCorrelations": "by-strategy",
                "symbolFilter": {
                     "included": ["GBPJPY","GBPNZD","EURJPY"]
                    },      "copyStopLoss": true,
                    "copyTakeProfit": true
                }
                ]
            }';
    // $response =   json_decode( $post_string,true);
    // dd($response);
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://copyfactory-api-v1.new-york.agiliumtrade.ai/users/current/configuration/subscribers/" . $accountid,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => $post_string,
        CURLOPT_HTTPHEADER => [
            "auth-token:" . $token . "",
            "Content-Type: application/json",
            "Accept: application/json",
        ],
    ]);
    $response = curl_exec($curl);
    var_dump($response);
    // ###############################################################
    // ########################### SUBSCRIPE #########################
    // ###############################################################


    // ###############################################################
    // ########################### ADD USER  #########################
    // ###############################################################
    // $post_string =
    //     '{
    // "symbol": "EURUSD",
    // "magic": 1200,
    // "quoteStreamingIntervalInSeconds": 2.5,
    // "tags": [
    //     "string"
    // ],
    // "metadata": {},
    // "reliability": "high",
    // "resourceSlots": 1,
    // "copyFactoryResourceSlots": 1,
    // "region": "new-york",
    // "name": "Mohamed2",
    // "manualTrades": false,
    // "copyFactoryRoles": [
    //     "SUBSCRIBER"
    // ],
    // "slippage": 0,
    // "login": "12657413",
    // "password": "jsbc87",
    // "server":  "ICMarketsSC-Demo01",
    // "platform": "mt4",
    // "type": "cloud-g2",
    // "application": "MetaApi",
    // "baseCurrency": "USD",
    // "riskManagementApiEnabled": false,
    // "metastatsHourlyTarificationEnabled": true
    // }';
    // //substr($_REQUEST["appMode"],0,5)=="AppCT")

    // $curl = curl_init();
    // $token = "eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1NmIzYjEwNzI0M2ViNjlhMDMxNjExZDVjNTI5MjBiZSIsInBlcm1pc3Npb25zIjpbXSwiYWNjZXNzUnVsZXMiOlt7ImlkIjoidHJhZGluZy1hY2NvdW50LW1hbmFnZW1lbnQtYXBpIiwibWV0aG9kcyI6WyJ0cmFkaW5nLWFjY291bnQtbWFuYWdlbWVudC1hcGk6cmVzdDpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciIsIndyaXRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoibWV0YWFwaS1yZXN0LWFwaSIsIm1ldGhvZHMiOlsibWV0YWFwaS1hcGk6cmVzdDpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciIsIndyaXRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoibWV0YWFwaS1ycGMtYXBpIiwibWV0aG9kcyI6WyJtZXRhYXBpLWFwaTp3czpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciIsIndyaXRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoibWV0YWFwaS1yZWFsLXRpbWUtc3RyZWFtaW5nLWFwaSIsIm1ldGhvZHMiOlsibWV0YWFwaS1hcGk6d3M6cHVibGljOio6KiJdLCJyb2xlcyI6WyJyZWFkZXIiLCJ3cml0ZXIiXSwicmVzb3VyY2VzIjpbIio6JFVTRVJfSUQkOioiXX0seyJpZCI6Im1ldGFzdGF0cy1hcGkiLCJtZXRob2RzIjpbIm1ldGFzdGF0cy1hcGk6cmVzdDpwdWJsaWM6KjoqIl0sInJvbGVzIjpbInJlYWRlciJdLCJyZXNvdXJjZXMiOlsiKjokVVNFUl9JRCQ6KiJdfSx7ImlkIjoicmlzay1tYW5hZ2VtZW50LWFwaSIsIm1ldGhvZHMiOlsicmlzay1tYW5hZ2VtZW50LWFwaTpyZXN0OnB1YmxpYzoqOioiXSwicm9sZXMiOlsicmVhZGVyIiwid3JpdGVyIl0sInJlc291cmNlcyI6WyIqOiRVU0VSX0lEJDoqIl19LHsiaWQiOiJjb3B5ZmFjdG9yeS1hcGkiLCJtZXRob2RzIjpbImNvcHlmYWN0b3J5LWFwaTpyZXN0OnB1YmxpYzoqOioiXSwicm9sZXMiOlsicmVhZGVyIiwid3JpdGVyIl0sInJlc291cmNlcyI6WyIqOiRVU0VSX0lEJDoqIl19LHsiaWQiOiJtdC1tYW5hZ2VyLWFwaSIsIm1ldGhvZHMiOlsibXQtbWFuYWdlci1hcGk6cmVzdDpkZWFsaW5nOio6KiIsIm10LW1hbmFnZXItYXBpOnJlc3Q6cHVibGljOio6KiJdLCJyb2xlcyI6WyJyZWFkZXIiLCJ3cml0ZXIiXSwicmVzb3VyY2VzIjpbIio6JFVTRVJfSUQkOioiXX0seyJpZCI6ImJpbGxpbmctYXBpIiwibWV0aG9kcyI6WyJiaWxsaW5nLWFwaTpyZXN0OnB1YmxpYzoqOioiXSwicm9sZXMiOlsicmVhZGVyIl0sInJlc291cmNlcyI6WyIqOiRVU0VSX0lEJDoqIl19XSwidG9rZW5JZCI6IjIwMjEwMjEzIiwiaW1wZXJzb25hdGVkIjpmYWxzZSwicmVhbFVzZXJJZCI6IjU2YjNiMTA3MjQzZWI2OWEwMzE2MTFkNWM1MjkyMGJlIiwiaWF0IjoxNzEzMTA3ODE0fQ.k-JcNtL8nZKbJEVw8LgcN5dH1BHAc__UJZQAjQCsYCzG0R-J07DOHiwuJrkh03rV010TRV4bARyEZ1NEEIdMFfaESKgb2G1LikTSRt_ITQ_UJR4ZmUd2nyRd3Gcl8tCJDt-IG9F9aZ0FXPOvxO7znzIIgeLJXTowQJZpP870RtbckmUxEM3VGABqBiDYYavBLf8SaSX4DIDIuU9QKZuL7S98ZRbk9XPbnAiOUrdguYAT7fqsROzl9rE93HuuhIQW1hYByQLuxjN_xw7RsqbkMmMQyrezvgwk5ohJexrNO_RxqgBpihd1_oTaJodJ8wjrbv_2OsPXSOZjQ9eztn1bmpY1rA68jFqpYtG51zYrSY9_E09t8h-uojHUsZS53aA_jibLoztJS-pO8pa8cyWfizsErS8w2Nor6T7PB0Z1Co515BsKNUH_hfTf2hvk3BxWty-c6WuCWXgXVSJT0qyBBmtmqGoL_bFJQ_LPX7hZMDrI_tkBEqEKakAW7HIZntmxGR3kRv47OvctZKYxjizVJh-JoOLPbmG8wwB6zLArWP14N73OJc8EZWfJZe7TOjDtXjhUTGuHsO0BH0WjKqM-6MESEASxhV8bega5KpFIgxhtMO-eFy19-9ozqs5kksfnYxelC6E8Qr3HxPn6IwnmJJ13HJOcMUj-HGGXQZh4BlU";
    // curl_setopt_array($curl, [
    //     CURLOPT_URL => "https://mt-provisioning-api-v1.agiliumtrade.agiliumtrade.ai/users/current/accounts",
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_POSTFIELDS => $post_string,
    //     CURLOPT_HTTPHEADER => [
    //         "auth-token:" . $token . "",
    //         "Content-Type: application/json",
    //     ],
    // ]);

    // $response = curl_exec($curl);
    // return ($response);
    // ###############################################################
    // ########################### ADD USER  #########################
    // ###############################################################




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
        Route::get('/test/{text?}', function (Request $request) {
            $gg = Setting::where('key', 'api_token_chat')->value('value');
            $url = 'https://api.openai.com/v1/chat/completions';

            $response = Http::withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . $gg,
            ])->post($url, [

                'model' => "gpt-3.5-turbo",
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    // ['role' => 'user', 'content' => 'this is blog post title:'.PHP_EOL.'help pepole'.PHP_EOL. 'Improve it for SEO and provide 6 alterntive titles to lang arabic'],
                    ['role' => 'user', 'content' => 'Translate the following English text to arabic: "' . $request->text . '"'],
                ],
                'temperature' => 0,
                'max_tokens' => 3900,
            ]);
            $rr =  $response->json();
            // $ar =    array_slice(preg_split('/\r\n|\r|\n/', $rr['choices'][0]['message']['content']), -5, 5);
            // dd ($rr['choices'][0]['message']['content']);
            dd($rr);



            // Session::put('token', 'asdasdasd');
            // Cache::Forever('token', 'asdasdasd');
            // return app('getSettings');

            // return   Browser::browserName() .' - '.Browser::platformName() .' - '.$request->ip() .' - ' .   json_decode( json_encode(Location::get($request->ip())), true);
            return    json_decode(json_encode(Location::get($request->ip())), true);


            $p1 = asset('files/1.jpg');
            $p1 = public_path('\files\1.jpg');
            $p2 = public_path('\files\watermark.png');

            $watermark = Image::make($p2);
            $watermark->rotate(45);

            $image = Image::make($p1);
            // $image->blur(18);
            $image->greyscale();

            // $imageWidth = $image->width();
            // $imageHeight = $image->height();
            // $positionX = ($imageWidth - $watermark->width()) / 2;
            // $positionY = ($imageHeight - $watermark->height()) / 2;
            // // $image->insert($p2, 'center',  number_format($positionX),  number_format($positionY));
            $image->insert($watermark, 'center');
            return $image->response('jpg');
        });
        Route::get('/image', function () {

            // $p1 = asset('files/1.jpg');
            $p1 = public_path('\files\1.jpg');
            // $p2 = public_path('\files\watermark.png');
            $p2 = public_path('\files\stamp.png');

            $watermark = Image::make($p2);
            $watermark->rotate(10);

            $image = Image::make($p1);
            // $image->blur(18);
            // $image->greyscale();

            // $imageWidth = $image->width();
            // $imageHeight = $image->height();
            // $positionX = ($imageWidth - $watermark->width()) / 2;
            // $positionY = ($imageHeight - $watermark->height()) / 2;
            // // $image->insert($p2, 'center',  number_format($positionX),  number_format($positionY));
            $image->insert($watermark, 'center');
            return $image->response('jpg');
        });

        Route::get('/vimeo', Filemanger::class);
        Route::get('/new/course', NewCourse::class)->name('newcourse');
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
