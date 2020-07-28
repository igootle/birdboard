<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects; // In the next episode.

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // $project = Project::findOrFail(request('project'));

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {

        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',

        ]);


        // persist
        auth()->user()->projects()->create($attributes);
        // Project::create($attributes);

        // redirect
        return redirect('/projects');
    }
}
