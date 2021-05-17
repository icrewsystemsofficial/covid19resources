<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewOcrReaderPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ViewOcrReaderPage_LoadsCorrectly()
    {
        $response = $this->get('/ocr');
        $response->assertStatus(200);
        $response->assertSee('OCR Reader');
    }
}
