<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectTestFactory;
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

        $project = ProjectTestFactory::withTasks(1)->create();


        $this->patch($project->tasks[0]->path(), ['body'=> 'changed'])
               ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    public function test_a_project_can_have_tasks()
    {


      $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)->post($project->path(). '/tasks', ['body'=> 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    function test_a_task_can_be_updated()
    {
      // $this->withoutExceptionHandling();

      $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
        ->patch($project->tasks[0]->path(), [
         'body' => 'changed'
        ]);

        $this->assertDatabaseHas('tasks', [
         'body' => 'changed'
        ]);
    }

    function test_a_task_can_be_completed()
    {
      // $this->withoutExceptionHandling();
      $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
        ->patch($project->tasks[0]->path(), [
         'body' => 'changed',
         'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
         'body' => 'changed',
         'completed' => true
        ]);
    }

    function test_a_task_can_be_incompleted()
    {

      $this->withoutExceptionHandling();

      $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
        ->patch($project->tasks[0]->path(), [
         'body' => 'changed',
         'completed' => true
        ]);

        $this->patch($project->tasks[0]->path(), [
         'body' => 'changed',
         'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
         'body' => 'changed',
         'completed' => false
        ]);
    }

    public function test_a_task_requires_a_body()
    {


        $project = ProjectTestFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->actingAs($project->owner)->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
