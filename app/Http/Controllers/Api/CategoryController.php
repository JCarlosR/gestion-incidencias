<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;

class CategoryController extends Controller
{
    public function byProject(Request $request)
    {
    	$project_id = $request->input('project_id');
    	$data['categories'] = Project::find($project_id)->categories;
    	
    	return $data;
    }
}
