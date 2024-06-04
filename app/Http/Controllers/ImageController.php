<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{

    public function uploadImage(Request $request)
    {
        $file = $request->file('file');
        $path = public_path('files/blog/editor');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $imageName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($path, $imageName);

        return response()->json(['url' => asset('files/blog/editor/' . $imageName)]);
    }

}
