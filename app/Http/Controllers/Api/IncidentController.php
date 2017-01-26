<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Incident;

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
}
