<?php

namespace Tests\Feature;

use Tests\TestCase;

class TutorialTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_example_2(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * A basic feature test example.
     */
    public function test_check_if_home_page_work_correctly(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //---------------------------------------------------------------------------------
    public function example_2(): void // will Not Execute Because of the name
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
