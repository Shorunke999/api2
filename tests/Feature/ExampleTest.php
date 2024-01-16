<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->post('/api/Register',[
            'email' => 'd1349@gmail.com',
            'password' => 'shornke',
            'role' => 1,
        ]);
        $response->ddSession();
    }
}
