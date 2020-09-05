<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    public function index()
    {
      //   $projects = auth()->user()->projects()->orderBy('updated_at', 'desc')->get();
        $projects = auth()->user()->accessibleProjects();
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

    public function edit(Project $project)
    {
       return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request)
    {


      // $request->save();
      // return redirect($request->project()->path());

      return redirect($request->save()->path());

    }

    public function destroy(Project $project)
    {
      $this->authorize('update', $project);
       $project->delete();
       return redirect('/projects');
    }

    public function store()
    {

       $attributes = $this->validateRequest();


        // persist
        $project = auth()->user()->projects()->create($attributes);

        return redirect($project->path());
    }

    protected function validateRequest()
    {
      $attributes = request()->validate([
         'title' => 'sometimes | required',
         'description' => 'sometimes | required',
         'notes' => 'nullable'

     ]);
     return $attributes;
    }

}
