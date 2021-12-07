<?php

namespace Tests\Feature;

use App\Model\User;
use App\Model\Alert;
use App\Model\Item;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlertTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldGetAlertList(): void
    {
        $this->seed();
        $alerts = $this->createAlerts();
        $user = $this->createUser();

        $response = $this->actingAs($user, 'api')
            ->getJson('/api/alerts');


        $response->assertOk();
        // $response->assertJsonFragment($alerts->toArray());
    }

    public function testShouldCreateAlert(): void
    {
        $this->seed();

        $item = Item::inRandomOrder()->first();
        $user = $this->createUser();

        $response = $this->actingAs($user, 'api')
            ->postJson('/api/alerts', ['item_id' => $item->id, 'max_price' => '5000']);

        $response->assertOk();
    }

    private function createUser(): User
    {
        return factory(User::class)->create();
    }

    private function createAlerts(): Collection
    {
        return factory(Alert::class, 10)->make();
    }
}
