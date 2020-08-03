<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    function test_it_belongs_to_a_project()
    {
      $task = factory(Task::class)->create();
      $this->assertInstanceOf(Project::class, $task->project);
    }

    function test_it_has_a_path()
    {
       $task = factory(Task::class)->create();
       $this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());

    }

}
