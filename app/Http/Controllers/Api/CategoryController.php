<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;

class CategoryController extends Controller
{
    public function byProject($id)
    {
    	$data['categories'] = Project::find($id)->categories;
    	return $data;
    }
}
