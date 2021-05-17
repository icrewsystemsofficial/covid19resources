<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewHowTo extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Howto_PageLoadsCorrectly()
    {
        $response = $this->get('/how-to');
        $response->assertSee('A comprehensive guide for the website');

        $response->assertStatus(200);
    }
}
