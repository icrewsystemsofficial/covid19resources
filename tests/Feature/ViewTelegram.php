<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTelegram extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_TelegramPageLoadsCorrectly()
    {
        $response = $this->get('/telegram');
        $response->assertSee('Telegram Crowdsourced Resource Channels');

        $response->assertStatus(200);
    }
}
