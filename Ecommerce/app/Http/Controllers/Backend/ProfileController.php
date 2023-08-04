<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AdminUpdateProfileRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;

class ProfileController extends Controller
{
    public function update_profile(AdminUpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('image')) {
            File::exists(public_path($user->image_path)) && File::delete(public_path($user->image_path)); // delete old image (if any)

            $file_name = time() . '_' . $request['image']->getClientOriginalName();
            $request['image']->move(public_path('uploads'), $file_name);
            $path = 'uploads/' . $file_name;
            $user->image_path = $path;
        }

        $user->save();

        toastr()->success('Profile updated successfully');
        return redirect()->route('admin.profile');
    }

    public function update_password(AdminUpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password updated successfully');
        return redirect()->route('admin.profile')->with('success', 'Password updated successfully');
    }
}
