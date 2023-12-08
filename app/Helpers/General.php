<?php

use Illuminate\Support\Facades\File;

function savefile($course_id = null, $folder = 'course')
{
    $path = public_path() . '/files' . '/' . $folder . '/' . '1';
    if (!File::exists($path)) {
        mkdir($path, 0777, true);
    }
}
function saveimage($course_id = null, $folder = 'course')
{
}
