<?php

namespace Tests\Feature;

use App\Model\User;
use App\Model\Alert;
use App\Model\Item;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
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
        $response->assertJsonCount($alerts->count());
    }

    public function testShouldCreateAlert(): void
    {
        $this->seed();
        $item = $this->getRandomItem();
        $user = $this->createUser();
        $payload = ['item_id' => $item->id, 'max_price' => '5000'];

        $response = $this->actingAs($user, 'api')
            ->postJson('/api/alerts', $payload);

        $response->assertOk();
        $this->assertDatabaseHas('alerts', $payload);
    }

    public function testShouldNotAllowCreationOfAnAlertWithoutMaxPriceOrItemId(): void
    {
        $this->seed();
        $user = $this->createUser();

        $response = $this->actingAs($user, 'api')
            ->postJson('/api/alerts', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testShouldUpdateAlert(): void
    {
        $this->seed();
        $item = $this->getRandomItem();
        $user = $this->createUser();
        $alert = factory(Alert::class)->create(['item_id' => $item->id, 'max_price' => '100']);
        $payload = ['max_price' => '500'];

        $response = $this->actingAs($user, 'api')
            ->patchJson("/api/alerts/$alert->id", $payload);

        $response->assertOk();
        $this->assertDatabaseHas('alerts', $payload);
    }

    public function testShouldDeleteAlert(): void
    {
        $this->seed();
        $item = $this->getRandomItem();
        $user = $this->createUser();
        $alert = factory(Alert::class)->create(['item_id' => $item->id, 'max_price' => '100']);

        $response = $this->actingAs($user, 'api')
            ->deleteJson("/api/alerts/$alert->id");

        $response->assertOk();
        $this->assertSoftDeleted($alert);
    }

    private function getRandomItem(): Item
    {
        return Item::inRandomOrder()->first();
    }

    private function createUser(): User
    {
        return factory(User::class)->create();
    }

    private function createAlerts(): Collection
    {
        return factory(Alert::class, 10)->create();
    }
}
