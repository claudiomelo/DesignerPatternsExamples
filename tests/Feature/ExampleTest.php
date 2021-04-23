<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        // $response = $this->call('GET', 'strategyPattern/calculateIssTax?value=25');
        // $this->assertResponseOK();

        $response->assertStatus(200);
    }
}
