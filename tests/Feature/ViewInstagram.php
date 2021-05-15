<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewInstagram extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_InstgramLoadsCorrectly()
    {
        $response = $this->get('/instagram');
        $response->assertSee('Instagram Crowdsourced Resources');

        $response->assertStatus(200);
    }
}
