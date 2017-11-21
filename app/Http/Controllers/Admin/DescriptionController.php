<?php

namespace App\Http\Controllers\Admin;

use App\PredefinedDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DescriptionController extends Controller
{
    public function index()
    {
        $descriptions = PredefinedDescription::pluck('description');
        return view('admin.descriptions.index')->with(compact('descriptions'));
    }

    public function store(Request $request)
    {
        $descriptions = $request->input('descriptions');

        PredefinedDescription::truncate();
        foreach ($descriptions as $description) {
            PredefinedDescription::create([
                'description' => $description
            ]);
        }

        $notification = 'La lista de descripciones se ha actualizado exitosamente!';
        return back()->with(compact('notification'));
    }
}
