<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    function test_only_the_owner_of_a_project_may_add_task()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->post($project->path(). '/tasks', ['body'=> 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);
    }

    function test_only_the_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();
        $project = factory('App\Project')->create();

        $task = $project->addTask('test task');

        $this->patch($task->path(), ['body'=> 'changed'])
               ->assertStatus(404);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_a_project_can_have_tasks()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $this->post($project->path(). '/tasks', ['body'=> 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    function test_a_task_can_be_updated()
    {
       $this->withoutExceptionHandling();
      $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $task = $project->addTask('test task');

        $this->patch($project->path() . '/tasks/' . $task->id, [
           'body' => 'changed',
           'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
         'body' => 'changed',
         'completed' => true
        ]);
    }

    public function test_a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(
            factory(Project::class)->raw()
        );

        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
