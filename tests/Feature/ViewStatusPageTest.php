<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewStatusPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ViewStatusPage_LoadsCorrectly()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/status');
        $response->assertStatus(200);
        $response->assertSee('Covid19Resources');
    }
}
