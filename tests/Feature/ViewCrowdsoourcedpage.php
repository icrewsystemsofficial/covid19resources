<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewCrowdsoourcedpage extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_CrowdSourcedPageLoadsCorrectly()
    {
        $response = $this->get('/crowdsourced');
        $response->assertSee('Crowd-Sourced Resources');

        $response->assertStatus(200);
    }
}
