<?php

namespace Tests\Feature;
use App\Http\Controllers\Dashboard\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewResourcepage extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Resource_page_rendered()
    {       
        $response = $this->get('/admin/resources');
        $response->assertSee("Resources Admin");
        $response->assertStatus(200);

    }
    public function test_import_Resource_page_rendered()
    {       
        $response = $this->get('/admin/resources/import/new');
        $response->assertSee("Import Resources");
        $response->assertStatus(200);

    }
}
