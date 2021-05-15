<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewWebsite extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_WebsitePageLoadsCorrectly()
    {
        $response = $this->get('/websites');
        $response->assertSee('Websites');
        $response->assertStatus(200);
    }
}
