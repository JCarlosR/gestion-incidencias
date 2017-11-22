<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $rules = [
            'file' => 'required|file|max:10240'
        ];
        $messages = [
            'file.required' => 'Olvidó adjuntar el archivo.',
            'file.max' => 'El archivo adjunto no debe exceder los 10MB.'
        ];

        $this->validate($request, $rules, $messages);

        $file = $request->file('file');
        $path = public_path('/attachments');
        $fileName = uniqid() . '-' . $file->getClientOriginalName();
        $moved = $file->move($path, $fileName);

        if ($moved) {
            $attachment = new Attachment();
            $attachment->incident_id = $request->input('incident_id');
            $attachment->attachment = $fileName;
            $attachment->user_id = auth()->user()->id;
            $attachment->save();
        }

        return back()->with('notification', 'El archivo se ha adjuntado con éxito.');
    }
}
