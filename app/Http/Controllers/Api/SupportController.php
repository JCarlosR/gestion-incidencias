<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Incident;

class SupportController extends Controller
{
    public function incidentCount()
    {
    	$supports = User::where('role', 1)->get();
    	$incidents_by_support = [];
    	foreach ($supports as $support) {
    		$current_support['name'] = $support->name;
    		$current_support['count'] = Incident::where('support_id', $support->id)->count();
    		$incidents_by_support[] = $current_support;
    	}

    	$data['incidents_by_support'] = $incidents_by_support;
    	return $data;
    }
}
