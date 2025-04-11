<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_homepage_works_correctly(): void
    {
        // Steps
        // 1. Visit the homepage "/"
        $response = $this->get(route('home'));
        // 2. Response Status Code is 200
        $response->assertStatus(200);
        // 3. View (Welcome) Open Successfully
        $response->assertViewIs('welcome');
        // 4. check if has specific text that not can be changed
        $response->assertSeeText('Deploy now');
    }
}
