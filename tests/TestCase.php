<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
      //   $this->actingAs(factory($user ?: 'App\User')->create());
      $user = $user ?: factory('App\User')->create();

      $this->actingAs($user);

      return $this;
    }

}
