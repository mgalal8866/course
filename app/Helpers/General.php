<?php

use App\Models\Setting;
use Illuminate\Support\Facades\File;

function Resp($data = null, $msg = null, $status = 200, $statusval = true)
{
    if ($status == 422) {
        return response()->json(['errors' => $data, 'msg' => $msg, 'status' => $status, 'statusval' => $statusval = false], $status);
    } elseif ($status != 200) {
        return response()->json(['msg' => $msg, 'status' => $status, 'statusval' => $statusval = false], $status);
    } else {
        return response()->json(['data' => $data, 'msg' => $msg, 'status' => $status, 'statusval' => $statusval], $status);
    }
}

 function path($course_id, $folder)
{
    $p =  '/files' . '/' . $folder . '/' . $course_id . '/';
    $path = asset($p) ;
    if (!File::exists($path)) {
        mkdir($path, 0777, true);
    }
    return  $path. '/';
}
// function getSetting($key, $default = null)
// {
//     $setting = Setting::find($key);
//     return $setting ? $setting->value : $default;
// }

if (!function_exists('getSetting')) {
    function getSetting()
    {
        try {
            return app('getSetting');

        } catch (Exception $exception) {
            return false;
        }
    }
}
