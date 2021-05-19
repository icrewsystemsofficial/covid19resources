<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewDiscord extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Discord_PageLoadsCorrectly()
    {
        $response = $this->get('/discord');
        $response->assertSee('Discord Crowdsourced Resource Servers');

        $response->assertStatus(200);
    }
}
