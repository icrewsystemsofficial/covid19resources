<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewSearchPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ViewSearchPage_LoadsCorrectly()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/search');
        $response->assertStatus(200);
        $response->assertSee('Keyword Search');
    }
}
