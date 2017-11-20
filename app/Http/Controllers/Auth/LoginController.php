<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Project;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    // Where to redirect users after login
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated()
    {
        $user = auth()->user();

        if (! $user->selected_project_id) {
            if ($user->is_admin || $user->is_client) {
                $user->selected_project_id = Project::first()->id;

            } else { // is_support
                // y si el usuario de soporte no está asociado a ningún proyecto?
                $first_project = $user->projects->first();
                
                if ($first_project)
                    $user->selected_project_id = $first_project->id;                
            }

            $user->save();
        }
    }
}
