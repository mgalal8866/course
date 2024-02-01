<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'phone',
                'value' => '01024346011',
            ],
            [
                'key' => 'address',
                'value' => 'القاهرة - مدينة نصر - حي السفارات',
            ],
            [
                'key' => 'mail',
                'value' => 'info@yusr.com',
            ],
            [
                'key' => 'facebook',
                'value' => 'facebook.com',
            ],
            [
                'key' => 'instegram',
                'value' => 'instegram.com',
            ],
            [
                'key' => 'telegram',
                'value' => 'telegram.com',
            ],
            [
                'key'   => 'linkedin',
                'value' => 'linkedin.com',
            ],
            [
                'key'   =>  'youtube',
                'value' => 'youtube.com',
            ],
            [
                'key' => 'description',
                'value' => 'يهدف مركز اليسر للتدريب إلى تسهيل العملية التعليمية للطالب وتقديمها بطريقة عصرية تضمن سرعة الوصول للمحتوى التعليمي وشرحه بطريقة بسيطة وسهلة على يد مدربين اكفاء.',
            ],
            [
                'key' => 'copyright',
                'value' =>  'كل الحقوق محفوظة اليسر | 2023',

            ],
            [
                'key' => 'section1_status',
                'value' => '1',
            ],
            [
                'key' => 'section1_title',
                'value' => 'مركز اليسر للتدريب هو طريقك للنجاح',
            ],
            [
                'key' => 'section1_sub_title',
                'value' => 'أول دورة قدرات معتمدة على مستوى المملكة',
            ],
            [
                'key' => 'section1_body',
                'value' => 'يهدف مركز اليسر للتدريب إلى تسهيل العملية التعليمية للطالب وتقديمها بطريقة عصرية تضمن سرعة الوصول للمحتوى التعليمي وشرحه بطريقة بسيطة وسهلة على يد مدربين اكفاء.',
            ],
            [

                'key' => 'section2_status',
                'value' => '1',
            ],
            [
                'key' => 'section2_title',
                'value' => 'اهلا بك في منصة اليسر',
            ],
            [
                'key' => 'section2_body',
                'value' => 'يهدف مركز اليسر للتدريب إلى تسهيل العملية التعليمية للطالب وتقديمها بطريقة عصرية تضمن سرعة الوصول للمحتوى التعليمي وشرحه بطريقة بسيطة وسهلة على يد مدربين اكفاء. لا تفكر كثيراً ولا تبحث أكثر فمهما كان ما تبحث عنه في كيان نضعه بين يديك ونقربه إليك حيث تصبح العملية التعليمية أسهل مما تظن وأجمل مما تعتقد؛ معلماً كان من تبحث عنه أو شرحاً أو جزءاً من معلومة فلن تحتاج إلا لثوانٍ معدودة لتجد في مركز كيان للتدريب ما تبحث عنه.. لا غنى لك عن مركز اليسر للتدريب لأن العلم معنا أسهل.',
            ],
            [
                'key' => 'section2_image',
                'value' => 'logo_pattern.png',
            ],
            [
                'key' => 'section3_status',
                'value' =>  '1',
            ],
            [
                'key' => 'section3_title',
                'value' => 'نقدم لكم أفضل الدورات المتنوعة في منصة اليسر',

            ],
            [
                'key' => 'section4_status',
                'value' => '1',

            ],
            [
                'key' => 'section4_title',
                'value' => 'لدينا أفضل المدرسين فى الوطن العربي بمنصة اليسر',

            ],
            [
                'key' => 'section4_body',
                'value' => 'يهدف مركز اليسر للتدريب إلى تسهيل العملية التعليمية للطالب وتقديمها بطريقة عصرية تضمن سرعة الوصول للمحتوى التعليمي وشرحه بطريقة بسيطة وسهلة على يد مدربين اكفاء. لا تفكر كثيراً ولا تبحث أكثر فمهما كان ما تبحث عنه في كيان نضعه بين يديك ونقربه إليك حيث تصبح العملية التعليمية أسهل مما تظن وأجمل مما تعتقد؛ معلماً كان من تبحث عنه أو شرحاً أو جزءاً من معلومة فلن تحتاج إلا لثوانٍ معدودة لتجد في مركز كيان للتدريب ما تبحث عنه.. لا غنى لك عن مركز اليسر للتدريب لأن العلم معنا أسهل.',

            ],
            [
                'key' => 'section4_image',
                'value' => 'instructors_cover.png',

            ],
            [
                'key' => 'section5_status',
                'value' => '1',

            ],
            [
                'key' => 'section5_title',
                'value' => 'مقالات اليسر: مصدركم الموثوق للتحفيز والتعلم',

            ],
            [
                'key' => 'section5_sub_title',
                'value' => 'استكشف أفق المعرفة والتطوير الشخصي من خلال مجموعة من مقالاتنا الملهمة والمتخصصة في عالم التعلم الإلكتروني.',
            ],
            [
                'key' => 'section6_status',
                'value' =>  '1',

            ],
            [
                'key' => 'section6_title',
                'value' =>  'قسم الأسئلة الشائعة',

            ],
            [
                'key' => 'section6_sub_title',
                'value' => 'اكتشف المزيد حول منصة "اليسر" من خلال الأسئلة الشائعة التالية',

            ],
            [

                'key' => 'section7_status',
                'value' => '1',
            ],
            [
                'key' => 'section7_title',
                'value' => 'قسم الأسئلة الشائعة',
            ],
            [
                'key' => 'section7_sub_title',
                'value' => 'اكتشف المزيد حول منصة "اليسر" من خلال الأسئلة الشائعة التالية'
            ],
            [

                'key' => 'section8_status',
                'value' => '1',
            ],
            [
                'key' => 'section8_title',
                'value' => 'انضم إلينا في رحلة التعلم مع اليسر',
            ],
            [
                'key' => 'section8_sub_title',
                'value' => 'اكتشف المزيد حول منصة "اليسر" من خلال الأسئلة الشائعة التالية',

            ]

        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('settings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Setting::insert($data);
    }
}
