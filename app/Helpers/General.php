<?php

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
function savefile($course_id = null, $folder = 'courses')
{
    $path = public_path() . '/files' . '/' . $folder . '/' . $course_id;
    if (!File::exists($path)) {
        mkdir($path, 0777, true);
    }
    File::put($path . '/' . $imageName, base64_decode($image));
    return  $imageName;
}
function saveimage($course_id = null, $folder = 'course')
{
}
