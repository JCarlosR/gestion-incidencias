<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function postImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $user = Auth::user();
        $extension = $request->file('image')->getClientOriginalExtension();
        $file_name = $user->id . '.' . $extension;

        $path = public_path('images/users/' . $file_name);

        Image::make($request->file('image'))
            ->fit(128, 128)
            ->save($path);

        $user->image = $extension;
        $user->save();

        $data['success'] = true;
        $data['file_name'] = $file_name;
        return $data;
    }
}
