<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Incident;
use App\Project;

class IncidentController extends Controller
{

    public function stateCount()
    {
    	$incidents = Incident::all();

    	$pending = 0;
    	$solved = 0;
    	$assigned = 0;

		foreach ($incidents as $incident) {
			switch ($incident->state) {
				case 'Resuelto':
					++$solved;
					break;
				case 'Asignado':
					++$assigned;
					break;
				default:
					++$pending;
					break;
			}
		}

		$data['pending'] = $pending;
		$data['solved'] = $solved;
		$data['assigned'] = $assigned;
    	return $data;
    }

    public function store(Request $request)
    {
    	$incident = new Incident();

    	$incident->title = $request->input('title');
    	$incident->description = $request->input('description');
    	$incident->severity = $request->input('severity');

 		$incident->category_id = $request->input('category_id');
 		$incident->project_id = $request->input('project_id');
 		
 		$incident->client_id = $request->input('client_id');
        $incident->level_id = Project::find($request->input('project_id'))->first_level_id;

        $success = $incident->save();

        $data['error'] = !$success;
        return $data;
    }
}
