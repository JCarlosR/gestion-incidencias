<?php

namespace App\Http\Controllers;

use App\Incident;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('control_number')) {
            $control_number = $request->input('control_number');
            $results = Incident::where('control_number', 'like', "%$control_number%")->get();
            return view('search.index')->with(compact('results', 'control_number'));
        }
        return back();
    }
}
