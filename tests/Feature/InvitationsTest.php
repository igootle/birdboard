<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
   use RefreshDatabase;

   public function test_a_project_can_invite_a_user()
   {
      // Given I have a project
      $project = ProjectTestFactory::create();

      // And the owner of the project invites another user
      $project->invite($newUser = factory(User::class)->create());


      // Then, that new user will have permission to add tasks
      $this->signIn($newUser);
      $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);

      $this->assertDatabaseHas('tasks', $task);




   }
}
