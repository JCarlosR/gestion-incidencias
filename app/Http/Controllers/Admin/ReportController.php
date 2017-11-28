<?php

namespace App\Http\Controllers\Admin;

use App\Incident;
use App\PredefinedDescription;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('project_id')) {
            $descriptions = PredefinedDescription::pluck('description');
            $project = Project::findOrFail($request->input('project_id'));
            return view('admin.reports.show')->with(compact('descriptions', 'project'));
        }
        // else
        $projects = Project::all();
        return view('admin.reports.index')->with(compact('projects'));
    }

    public function byProjects()
    {
        $projects = Project::all();
        $data = [];
        foreach ($projects as $project) {
            $item = [];
            $item['name'] = $project->name;
            $item['y'] = Incident::where('project_id', $project->id)->count();
            $data[] = $item;
        }
        return $data;
    }

    public function byPredefinedDescriptions(Project $project)
    {
        $descriptions = PredefinedDescription::pluck('description');
        $data = [];
        foreach ($descriptions as $description) {
            $item = [];
            $item['name'] = $description;
            $item['y'] = Incident::where('project_id', $project->id)->where('description', $descriptions)->count();
            $data[] = $item;
        }
        return $data;
    }
}
