<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\VendorUpdateProfile;
use App\Http\Requests\VendorUpdatePassword;

class VendorController extends Controller
{
    public function update_profile(VendorUpdateProfile $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_id = $request->phone;

        if ($request->has('image')) {
            File::exists(public_path($user->image_path)) && File::delete(public_path($user->image_path)); // delete old image (if any)

            $file_name = time() . '_' . $request['image']->getClientOriginalName();
            $request['image']->move(public_path('uploads'), $file_name);
            $user->image_path = 'uploads/' . $file_name;
        }

        $user->save();

        toastr()->success('Profile updated successfully');
        return redirect()->route('user.profile');
    }

    public function update_password(VendorUpdatePassword $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password updated successfully');
        return redirect()->route('user.profile');
    }
}
