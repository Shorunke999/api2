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
            'email' => 'd19@gmail.com',
            'password' => 'shornke',
            'user' => true
        ]);
        $response->ddSession();
    }
}
