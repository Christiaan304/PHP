<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageUploadTrait
{
    public function upload_image(Request $request, $input_name, string $path)
    {
        if ($request->hasFile($input_name)) {
            //delete old image if exists
            /*
            if (file_exists($input_name->image_path)) {
                unlink($input_name->image_path);
            }
            */

            $file_name = microtime(true) . uniqid() . '.' . $request->$input_name->getClientOriginalExtension();
            $request->$input_name->move(public_path($path), $file_name);

            return $path . '/' . $file_name;
        }
    }
}
