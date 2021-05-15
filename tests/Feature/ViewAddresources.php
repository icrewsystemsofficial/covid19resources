<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewAddresources extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_AddResourcesPageLoadsCorrectly()
    {
        $response = $this->get('add-resource');
        $response->assertSee('Add a resource');

        $response->assertStatus(200);
    }
}
