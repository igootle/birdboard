<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
      $this->authorize('update', $project);
      //   if(auth()->user()->isNot($project->owner)) {
      //       abort(403);
      //   }

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
      // if(auth()->user()->isNot($task->owner)) {
      //    abort(403);
      // }

      $this->authorize('update', $task->project);

      $attributes = request()->validate(['body' => 'required']);

      $task->update($attributes);

      request('completed') ? $task->complete() : $task->incomplete();

      return redirect($project->path());
    }
}
