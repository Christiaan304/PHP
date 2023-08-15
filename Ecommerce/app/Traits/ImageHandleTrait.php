<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageHandleTrait
{
    public function upload_image(Request $request, $input_name, $path)
    {
        if ($request->hasFile($input_name)) {
            $file_name = microtime(true) . uniqid() . '.' . $request->{$input_name}->getClientOriginalExtension();
            $request->{$input_name}->move(public_path($path), $file_name);

            return $path . '/' . $file_name;
        }
    }

    public function update_image(Request $request, $input_name, $path, $old_path = null)
    {
        if ($request->hasFile($input_name)) {
            //delete old image if exists
            if (File::exists(public_path($old_path))) {
                File::delete(public_path($old_path));
            }

            $file_name = microtime(true) . uniqid() . '.' . $request->{$input_name}->getClientOriginalExtension();
            $request->{$input_name}->move(public_path($path), $file_name);

            return $path . '/' . $file_name;
        }
    }

    public function delete_image($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
