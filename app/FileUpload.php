<?php

namespace App;

use File;
use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public static function photo($request, $fileName, $default = "")
    {
        $name = "";
        $photo = $request->photo;

        if($request)
        {
            $extension = substr(strrchr($photo,'.'),1);
            $name = rand(11111, 99999) . "." . date('Y-m-d') . "." . time() . "." . $extension;
            Storage::disk('photo')->put($name, $photo);

        } else {
            $name = $default;
        }

        return $name;
    }
}
