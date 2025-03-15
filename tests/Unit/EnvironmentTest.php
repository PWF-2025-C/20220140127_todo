<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
  public function testEnv()
  {
    $appName = env("YOUTUBE");

    self::assertEquals("Programmer Zaman Now", $appName);
  }
}
