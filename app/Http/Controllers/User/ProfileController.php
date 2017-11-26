<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function edit()
    {
        return view('profile.edit');
    }

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

    public function postData(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->save();

        $notification = 'Sus datos se han actualizado correctamente!';
        return back()->with(compact('notification'));
    }

    public function postPassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|confirmed'
        ];
        $messages = [
            'password.min' => 'La contraseña debe tener como mínimo 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ];
        $this->validate($request, $rules, $messages);

        $user = auth()->user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $notification = 'Su contraseña se ha actualizado correctamente.';
        return back()->with(compact('notification'));
    }
}
