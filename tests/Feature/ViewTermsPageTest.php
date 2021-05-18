<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTermsPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ViewTermsPage_LoadsCorrectly()
    {
        $response = $this->get('/terms');
        $response->assertStatus(200);
        $response->assertSee('Terms and Conditions');
    }
}
