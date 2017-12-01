<?php
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllUsersTest()
    {
        $response= $this->json('GET', '/api/utenti');
        $response->assertStatus(200);

    }
}
