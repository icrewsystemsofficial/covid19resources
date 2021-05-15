<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewHomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_HomeLoadsCorrectly()
    {
        $response = $this->get('/');
        $response->assertSee('State Wise COVID19 Resources. Awareness is the first step in this battle.');
        $response->assertStatus(200);
    }
}
