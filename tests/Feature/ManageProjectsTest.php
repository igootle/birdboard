<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectTestFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_projects()
    {

        $project = factory('App\Project')->create();

        //test_guests_cannot_view_projects
        $this->get('/projects')->assertRedirect('login');

        //test_guests_cannot_create_a_project
        $this->get('/projects/create')->assertRedirect('login');

        //test_guests_cannot_edit_a_project
        $this->get($project->path().'/edit')->assertRedirect('login');

        //test_guests_cannot_view_a_single_project
        $this->get($project->path())->assertRedirect('login');

        //test_guests_cannot_create_projects
        $this->post('/projects', $project->toArray())->assertRedirect('login');

    }



    public function test_a_user_can_create_a_project()
    {
      //   $this->withoutExceptionHandling();
        $this->signIn();
        // $this->actingAs(factory('App\User')->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here.'

        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();


        $response->assertRedirect($project->path());



        $this->get($project->path())
               ->assertSee($attributes['title'])
               ->assertSee($attributes['description'])
               ->assertSee($attributes['notes']);
    }

    public function test_a_user_can_update_a_project()
    {


      $project = ProjectTestFactory::create();

      $this->actingAs($project->owner)->patch($project->path(), $attributes = [
        'title' => 'Changed', 'description' => 'Changed', 'notes' => 'Changed'
      ])->assertRedirect($project->path());

      $this->get($project->path().'/edit')->assertStatus(200);

      $this->assertDatabaseHas('projects', $attributes);

    }

    public function test_a_user_can_update_a_projects_general_notes()
    {


      $project = ProjectTestFactory::create();

      // $this->actingAs($project->owner)->patch($project->path(), $attributes = [
      //     'notes' => 'Changed'
      // ]);
         $this->get($project->path(). '/edit')->assertRedirect('login');

    }

    public function test_a_user_can_view_their_project()
    {
        // actingAs กับ be ต่างกัน
        // $this->actingAs(factory('App\User')->create());
      //   $this->signIn();

      //   $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
      $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)->get($project->path())
        ->assertSee($project->title)
        ->assertSee($project->description);

    }

    public function test_an_authenticated_user_cannot_view_the_projects_of_other()
    {
        // $this->be(factory('App\User')->create());
        $this->signIn();

        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_an_authenticated_user_cannot_update_the_projects_of_other()
    {
        // $this->be(factory('App\User')->create());
        $this->signIn();

        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->patch($project->path())->assertStatus(403);
    }

    public function test_a_project_requires_a_title()
    {
        // $this->actingAs(factory('App\User')->create());
        $this->signIn();
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


}
