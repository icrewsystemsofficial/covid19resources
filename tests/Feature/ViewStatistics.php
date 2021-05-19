<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewStatistics extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Statistics_PageLoadsCorrectly()
    {
        $response = $this->get('/statistics');
        $response->assertSee('Statistics');

        $response->assertStatus(200);
    }
}
