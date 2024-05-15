<?php

namespace App\Livewire;

use Carbon\Carbon;
use Goutte\Client;
use App\Models\Quizes;
use App\Models\Stages;
use App\Models\Courses;
use App\Models\Lessons;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ScripingCourse extends Component
{
    public
        // $url = 'https://albaraah.sa/courses/%d9%82%d8%af%d8%b1%d8%a7%d8%aa-%d9%85%d8%ad%d9%88%d8%b3%d8%a8-221-%d8%b7%d8%a7%d9%84%d8%a8%d8%a7%d8%aa/',
        $url = 'https://albaraah.sa/courses/قدرات-محوسب-219-طلاب',
        $urllogin = 'https://albaraah.sa/login/',
        $username = "563517768",
        $password = "Zxcv@1234@Zxcv",
        $error,
        $data;

    use WithFileUploads, ImageProcessing;
    function videourl($url = null)
    {
        $videoId = '';
        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $matches)) {
            $videoId = $matches[1];
        } elseif (preg_match('/vimeo\.com\/user(\d+)/', $url, $matches)) {
            $videoId =       $matches[1];
        } else {
            echo "Invalid Vimeo URL.";
        }
        if (!empty($videoId)) {
            return   $videoId;
        } else {
            return "Vimeo Video ID not found in the URL.";
        }
    }
    public function getcourse()
    {
        $url = $this->url;
        $client = new Client();
        $data = [];
        session()->flash('status', 'جارى سحب بيانات الرئيسيه للكورس');
        try {
            $client = new Client();

            $website = $client->request('GET',  $url);
            $website->filter('.container')->each(function ($container) {
                $container->children()->each(function ($container_child) {
                    $container_child->filter('.image-content')->each(function ($image_conten) {
                        $image_conten->children()->each(function ($child) {
                            $this->data['image'] = $child->attr('src');
                        });
                    });

                    $container_child->filter('.content')->each(function ($content) {
                        $this->data['title']         = $content->children()->first()->text();
                        $this->data['category_name'] = $content->children('a')->first()->text();
                        $price             = $content->children('.data-price')->children('.price')->children('h6')->text();
                        $this->data['price']     = preg_replace('/[^0-9]/', '', $price);
                        $this->data['price_text']  = $content->children('.data-price')->children('.price')->eq(0)->children('p')->text() ?? '';
                        // $priceprint        = ($content->children('.data-price')->children('.price')->eq(1)->children('h6')->text())??'';
                        // $this->data['price_print']     = preg_replace('/[^0-9]/', '',$priceprint ??'');
                        // $this->data['price_print_text']  = $content->children('.data-price')->children('.price')->eq(1)->children('p')->text();
                        $this->data['currency']  = trim(preg_replace('/[0-9]+/', '', $price)); // Removes numbers
                        $this->data['validity']  = $content->children('.mt-2')->children('.col-md-6')->eq(1)->children('div')->text();
                        $this->data['duration']  =  $content->children('.mt-2')->children('.col-md-6')->eq(0)->children('div')->text();
                        $this->data['short_description']  =  $content->children('div')->eq(2)->text();
                    });
                    $container_child->filter('.tab-content')->each(function ($tabs) {
                        $tabs->children()->each(function ($child) {
                            if ($child->attr('id') == 'pills-home') {
                                $this->data['features'] = str_replace("\n", '',   $child->html());
                            }
                            if ($child->attr('id') == 'pills-profile') {
                                $this->data['conditions'] = str_replace("\n", '',  $child->html());
                            }
                            if ($child->attr('id') == 'pills-brief') {

                                $this->data['description'] =    str_replace("\n", '',  $child->html());
                            }
                        });
                    });
                });
            });

            $crawler = $client->request('GET', $this->urllogin);
            $form = $crawler->selectButton('wp-submit')->form();
            $form['log'] = $this->username;
            $form['pwd'] = $this->password;
            $client->submit($form);
            $website_login = $client->request('GET', $url);

            $website_login->filter('.courseViewBox')->each(function ($courseViewBox) use (&$url, &$client) {
                $courseViewBox->filter('.courseDetails')->each(function ($courseDetails) {
                    $this->data['target'] = $courseDetails->filter('#courseAccordion')->filter('#collapseOne')->filter('.mb-4')->text();
                    $courseDetails->filter('#courseAccordion')->filter('#collapseTwo')->filter('.mb-4')->children('ul')->children('li')->each(function ($collapsetwo, $index) {
                        $this->data['triners'][$index]['telegram'] = $collapsetwo->children('a')->attr('href');
                        $this->data['triners'][$index]['name'] = $collapsetwo->children('a')->text();
                    });
                    $courseDetails->filter('.detailsBlock')->each(function ($detailsBlock, $index) {
                        $this->data['files'][$index]['link'] = $detailsBlock->filter('a')->attr('href');
                        $this->data['files'][$index]['name'] = $detailsBlock->filter('a')->text();
                    });
                });
                $courseViewBox->filter('.courseListBody')->each(function ($detailsBlock, $index) use (&$url, &$client) {
                    $detailsBlock->children('.listItem')->each(function ($listItem, $index) use (&$url,  &$client) {
                        $maincategory = $listItem->children('.listItemHead')->text();
                        $this->data['stage'][$index]['name'] = $maincategory;
                        $currentCategory = null;
                        $listItem->children('.listItemBody')->each(function ($listItemBody) use ($maincategory, $index, &$currentCategory, &$url,  &$client) {
                            $classes = $listItemBody->attr('class');
                            if (strpos($classes, 'lessonCategory') !== false) {
                                $currentCategory = $listItemBody->text();
                                $this->data['stage'][$index]['chiled'][$currentCategory] = [];
                            } elseif ($currentCategory) {
                                // Only process if we have a current category
                                $listItemBody->filter('.listLesson')->each(function ($listLesson, $index2) use ($maincategory, $index, &$currentCategory, $listItemBody, &$url, &$client) {
                                    $lessonName = trim($listLesson->text());
                                    $lessonLink = $listLesson->filter('a.specialclass')->attr('href');
                                    $classes = $listItemBody->attr('class');
                                    $website_login = $client->request('GET', $url . $lessonLink);
                                    if (strpos($classes, 'is_test_class') !== false) {
                                        $testName = trim($listItemBody->filter('a.specialclass')->eq(1)->text());
                                        $testLink = $listItemBody->filter('a.specialclass')->eq(1)->attr('href');
                                        // dd($url . $testLink);
                                        $this->data['stage'][$index]['chiled'][$currentCategory][] = ['is_lesson' => 0, 'name' => $testName, 'link' => $testLink, 'link_v' =>  ''];
                                        $this->data['stage'][$index]['chiled'][$currentCategory][] = ['is_lesson' => 1, 'name' => $lessonName, 'link' => $lessonLink, 'link_v' =>  $website_login->filter('iframe')->eq(1)->attr('src')];
                                    } else {
                                        $this->data['stage'][$index]['chiled'][$currentCategory][] = ['is_lesson' => 1, 'name' => $lessonName, 'link' => $lessonLink, 'link_v' =>  $website_login->filter('iframe')->eq(1)->attr('src')];
                                    }
                                });
                            }
                        });
                    });
                });
                //       session()->flash('status', 'تم سحب بيانات الكورس بنجاح');
            });
            // $data  = Storage::disk('files')->get('data.json');
            // $this->data = json_decode($data, true);
            // //    dd($this->data);

            Storage::disk('files')->put('data1.json',  json_encode($this->data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            // dd($this->data);
        } catch (\Exception  $e) {
            dd($e->getMessage());
        }
    }
    public function save()
    {

        $data  = Storage::disk('files')->get('data.json');
        $this->data = json_decode($data, true);
        try {
            DB::beginTransaction();

            if (strpos($this->data['title'], "طلاب") !== false) {
                $course_gender = 1;
            } elseif (strpos($this->data['title'], "طالبات") !== false) {
                $course_gender = 2;
            } else {
                $course_gender = 0;
            }

            $currentDate = Carbon::now();
            $newDate = $currentDate->addMonths(3);
            $category = Category::firstOrCreate(['name' => $this->data['category_name']]);
            $CFC = Courses::updateOrCreate(['name'  => $this->data['title']], [
                'name'         => $this->data['title'],
                'duration'     => $this->data['duration'] ?? null,
                'validity'     => $this->data['validity'] ?? null,
                'course_gender'     => $course_gender ?? null,
                'short_description'  => $this->data['short_description'] ?? null,
                'description'  => $this->data['description'] ?? null,
                'category_id'  => $category->id  ?? null,
                'price'        => $this->data['price'] ?? null,
                'pricewith'    => $this->data['price_text'] ==  'شاملة كتاب الدورة PDF' ? 1 : 0,
                'start_date'   => $currentDate ?? null,
                'end_date'     => $newDate  ?? null,
                'time'         => "00:00" ?? null,
                'max_drainees' => 50 ?? null,
                'conditions'   => $this->data['conditions'] ?? null,
                'features'     => $this->data['features'] ?? null,
                'sections_guide'    => null,
                'how_start'    => $this->howtostart ?? null,
                'target'       => null,
                'telegramgrup' => null,
                'telegram'     => null,
                'next_cource'  => null,
                'free_tatorul' => null,
                'lang'         => 0,
                'statu'        => 1,
                'inputnum'     => 0,
                'file_free'    => $this->file_free ?? null,
                'answer_the_question'    =>  null,

            ]);
            if ($this->data['image']) {
                $contents = file_get_contents($this->data['image']);
                $dataX = $this->saveImageAndThumbnail($contents, false, $CFC->id, 'courses', 'images');
                $CFC->image =  $dataX['image'];
            }
            foreach ($this->data['files'] as $file) {
                if ($file['name'] === 'جدول الدورة') {
                    $CFC->schedule =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === 'للانضمام لقناة التليجرام') {
                    $CFC->telegram =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === "للإنضمام لقروب الاستفسارات") {
                    $CFC->telegramgrup =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === 'حقيبة الشرح') {
                    $CFC->file_explanatory =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === "أوراق عمل") {
                    $CFC->file_work =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === "حقيبة التجميعات") {
                    $CFC->file_aggregates =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === "حساب معدل الإنجاز") {
                    $CFC->calc_rate =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === "دليل المتدربين") {
                    $CFC->calc_rate =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === 'دليل الأقسام الأساسية') {
                    $CFC->sections_guide =  $file['link'];
                    break; // Exit the loop once found
                }
                if ($file['name'] === "آلية الرد على الاستفسارات") {
                    $CFC->answer_the_question =  $file['link'];
                    break; // Exit the loop once found
                }
            }
            $CFC->save();
            foreach ($this->data['stage']  as $stages) {
                $main = Stages::firstOrCreate(['name' => $stages['name'], 'parent_id' => null]);
                foreach ($stages['chiled']  as $value => $chiled) {
                    $category = Stages::firstOrCreate(['name' => $value, 'parent_id' => $main->id]);
                    foreach ($chiled  as $lesson) {
                        if ($lesson['is_lesson'] == 0) {
                            Quizes::updated(['id' => $lesson['link']], ['course_id' => $CFC->id]);
                        }
                        if ($lesson['is_lesson'] == 1) {
                            $url = ' https://vimeo.com/' . $this->videourl($lesson['link_v']);
                            $lesson = Lessons::create(['name' => $lesson['name'], 'link_video' => $url, 'is_lesson' => $lesson['is_lesson'], 'publish_at' => now()]);
                            $CFC->stages()->attach($category->id, ['course_id' => $CFC->id, 'lesson_id' => $lesson->id, 'publish_at' => now()]);
                        }
                    }
                }
            }
            DB::commit();

            // if ($this->image_course) {
            //     $dataX = $this->saveImageAndThumbnail($this->image_course, false, $CFC->id, 'courses', 'images');
            //     $CFC->image =  $dataX['image'];
            // }

            // if ($this->file_supplementary) {
            //     $file =  uploadfile($this->file_supplementary, "files/courses/"  . $CFC->id . "/doc");
            //     $CFC->file_supplementary =  $file;
            // }
            // if ($this->file_free) {
            //     $file =  uploadfile($this->file_free, "files/courses/"  . $CFC->id . "/doc");
            //     $CFC->file_free =  $file;
            // }

            // if ($this->file_test) {
            //     $file =  uploadfile($this->file_test, "files/courses/"  . $CFC->id . "/doc");
            //     $CFC->file_test =  $file;
            // }

            // foreach ($this->triner as $i) {
            //     $CFC->coursetrainers()->create(['trainer_id' => $i]);
            // }




        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
        }
    }
    public function render()
    {
        return view('scriping-course');
    }
}
