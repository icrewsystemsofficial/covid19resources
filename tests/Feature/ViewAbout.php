<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewAbout extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_AboutUs_PageLoadsCorrectly()
    {
        $response = $this->get('/about');
        $response->assertSee('Who we are, what is our mission');

        $response->assertStatus(200);
    }
}
