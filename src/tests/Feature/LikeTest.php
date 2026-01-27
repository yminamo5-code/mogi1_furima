<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;

class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_item()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create();
        $this->assertEquals(0, $item->likes()->count());

        $response = $this->post(route('item.like', ['item_id' => $item->id]));
        $response->assertStatus(302);

        $this->assertTrue($item->likes()->where('user_id', $user->id)->exists());
    }

    public function test_aicon()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create();

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);
        $response->assertSee('ハートロゴ_デフォルト.png', false);
        $response->assertDontSee('ハートロゴ_ピンク.png', false);

        $this->post(route('item.like', ['item_id' => $item->id]));

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);
        $response->assertSee('ハートロゴ_ピンク.png', false);
        $response->assertDontSee('ハートロゴ_デフォルト.png', false);
    }

    public function test_reaicon()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::factory()->create();

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);
        $response->assertSee('ハートロゴ_デフォルト.png', false);
        $response->assertDontSee('ハートロゴ_ピンク.png', false);

        $this->post(route('item.like', ['item_id' => $item->id]));

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);
        $response->assertSee('ハートロゴ_ピンク.png', false);
        $response->assertDontSee('ハートロゴ_デフォルト.png', false);

        $this->post(route('item.like', ['item_id' => $item->id]));

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);
        $response->assertSee('ハートロゴ_デフォルト.png', false);
        $response->assertDontSee('ハートロゴ_ピンク.png', false);
    }
}
