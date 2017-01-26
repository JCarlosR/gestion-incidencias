<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Project;
use App\Incident;

class ProjectController extends Controller
{
    public function all()
    {
    	$data['projects'] = Project::all();
    	return $data;
    }

    public function incidentCount()
    {
    	$projects = Project::all();

		$incidents_by_project = [];

    	foreach ($projects as $project) {
    		$current_project['name'] = $project->name;
    		$count = Incident::where('project_id', $project->id)->count();
    		$current_project['count'] = $count;

    		$incidents_by_project[] = $current_project;
    	}

    	$data['incidents_by_project'] = $incidents_by_project;
    	return $data;
    }
}
