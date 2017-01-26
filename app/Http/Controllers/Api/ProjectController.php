<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{
    public function all()
    {
    	$data['projects'] = Project::all();
    	return $data;
    }
}
