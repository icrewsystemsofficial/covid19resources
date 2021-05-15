<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewHelplines extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Helpline_PageLoadsCorrectly()
    {
        $response = $this->get('/helplines');
        $response->assertSee('State Helpline Numbers');

        $response->assertStatus(200);
    }
}
