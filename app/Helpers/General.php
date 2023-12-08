<?php

use Illuminate\Support\Facades\File;

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
