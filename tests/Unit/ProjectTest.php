<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_it_has_a_path()
    {
        $project = factory('App\Project')->create();
        $this->assertEquals('/projects/'.$project->id, $project->path());
    }
}
