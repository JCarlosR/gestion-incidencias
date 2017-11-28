<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\PredefinedDescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\Project;
use App\ProjectUser;

class IncidentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        $messages = $incident->messages;
        $attachments = $incident->attachments;
        return view('incidents.show')->with(compact('incident', 'messages', 'attachments'));
    }

    public function create()
    {
        $categories = Category::where('project_id', auth()->user()->selected_project_id)->get();
        $descriptions = PredefinedDescription::pluck('description');
        return view('incidents.create')->with(compact('categories', 'descriptions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, Incident::$rules, Incident::$messages);

        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->control_number = $request->input('control_number');
        $incident->title = $request->input('title');
        $description = $request->input('description');
        if ($description == '-1') {
            $incident->description = $request->input('my-description');
        } else {
            $incident->description = $description;
        }

        $user = auth()->user();

        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::findOrFail($user->selected_project_id)->first_level_id;

        $saved = $incident->save();

        if ($saved && $request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = public_path('/attachments');
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            if ($moved) {
                $attachment = new Attachment();
                $attachment->incident_id = $incident->id;
                $attachment->attachment = $fileName;
                $attachment->user_id = auth()->user()->id;
                $attachment->save();
            }
        }

        $notification = 'La incidencia se ha registrado exitosamente.';
        return back()->with(compact('notification'));
    }

    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;

        $descriptions = PredefinedDescription::pluck('description')->toArray();
        $customDescription = !in_array($incident->description, $descriptions);

        return view('incidents.edit')->with(compact(
            'incident', 'categories', 'descriptions', 'customDescription'
        ));
    }

    public function update(Request $request, $id)
    {
        // allow edit and use the existing ctrl number
        $rulesForEdit = Incident::$rules;
        $rulesForEdit['control_number'] = $rulesForEdit['control_number'] . ',id,' . $id;

        $this->validate($request, $rulesForEdit, Incident::$messages);

        $incident = Incident::findOrFail($id);

        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->control_number = $request->input('control_number');
        $incident->title = $request->input('title');

        $description = $request->input('description');
        if ($description == '-1') {
            $incident->description = $request->input('my-description');
        } else {
            $incident->description = $description;
        }

        $incident->save();
        return redirect("/ver/$id");        
    }

    public function take($id)
    {
        $user = auth()->user();

        if ($user->is_client)
            return back();

        $incident = Incident::findOrFail($id);

        // There is a relationship between user and project?
        $project_user = ProjectUser::where('project_id', $incident->project_id)
                                        ->where('user_id', $user->id)->first();

        if (! $project_user)
            return back();

        // The level is the same?
        if ($project_user->level_id != $incident->level_id)
            return back();
        
        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }

    public function solve($id)
    {
        $incident = Incident::findOrFail($id);

        // Is the user authenticated the author of the incident?
        if ($incident->client_id == auth()->id() || $incident->support_id == auth()->id()) {
            $incident->active = 0; // false

            $incident->closed_at = Carbon::now();
            $incident->closed_by = auth()->id();
            $incident->save();
        }

        return back();
    }

    public function open($id)
    {
        $incident = Incident::findOrFail($id);

        // Is the user authenticated the author of the incident?
        if ($incident->client_id == auth()->id() || $incident->support_id == auth()->id()) {
            $incident->active = 1; // true

            $incident->opened_at = Carbon::now();
            $incident->opened_by = auth()->id();
            $incident->save();
        }

        return back();
    }

    public function nextLevel($id)
    {
        $incident = Incident::findOrFail($id);
        $level_id = $incident->level_id;

        $project = $incident->project;
        $levels = $project->levels;

        $next_level_id = $this->getNextLevelId($level_id, $levels);

        if ($next_level_id) {
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();
            return back();
        }

        return back()->with('notification', 'No es posible derivar porque no hay un siguiente nivel.');
    }

    public function getNextLevelId($level_id, $levels)
    {
        if (sizeof($levels) <= 1)
            return null;

        $position = -1;
        for ($i=0; $i<sizeof($levels)-1; $i++) { // -1
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }

        if ($position == -1)
            return null;

        // if ($position == sizeof($levels)-1)
        //     return null;

        return $levels[$position+1]->id;
    }
}
