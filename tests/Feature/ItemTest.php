<?php

namespace Tests\Feature;

use App\Model\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldGetItemsList(): void
    {
        $this->seed();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->call('GET', '/api/items', ['per_page' => 20]);

        $response->assertOk();
    }
}
