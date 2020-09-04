<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;

use App\Activity;
use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectTestFactory;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ActivityTest extends TestCase
{
   use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_a_user()
    {
      $user = $this->signIn();


      // $project = ProjectTestFactory::ownedBy($user)->create();

      $project = factory(Project::class)->create();


      $this->assertInstanceOf(User::class, $project->activity->first()->user);

      // $this->assertEquals($user->id, $project->activity->first()->user->id);

    }
}
