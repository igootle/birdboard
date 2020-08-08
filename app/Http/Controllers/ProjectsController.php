<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    public function index()
    {
      //   $projects = auth()->user()->projects()->orderBy('updated_at', 'desc')->get();
        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // $project = Project::findOrFail(request('project'));
        $this->authorize('update', $project);
      //   if (auth()->user()->isNot($project->owner)) {
      //       abort(403);
      //   }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function update(Project $project)
    {
       $this->authorize('update', $project);
   //    if (auth()->user()->isNot($project->owner)) {
   //       abort(403);
   //   }
      $project->update(request(['notes']));

      return redirect($project->path());

    }

    public function store()
    {

        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3'

        ]);




        // persist
        $project = auth()->user()->projects()->create($attributes);
        // Project::create($attributes);

        // redirect
        return redirect($project->path());
    }
}
