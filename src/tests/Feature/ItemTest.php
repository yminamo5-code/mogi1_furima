<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_allitem()
    {
        $items = Item::factory()->count(3)->create([
            'itemname' => 'テスト商品',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        foreach ($items as $item) {
        $response->assertSee($item->name);
        }
    }

    public function test_sold()
    {
        $user = User::factory()->create();
        $item1 = Item::factory()->create(['itemname' => '商品A', 'user_id' => $user->id]);
        $item2 = Item::factory()->create(['itemname' => '商品B', 'user_id' => $user->id]);
        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item1->id,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertSee('SOLD'); 
    }

    public function test_other_myitem()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $item1 = Item::factory()->create(['itemname' => '自分の商品', 'user_id' => $user1->id]);
        $item2 = Item::factory()->create(['itemname' => '他人の商品', 'user_id' => $user2->id]);

        $response = $this->actingAs($user1)->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertSee('他人の商品');
        $response->assertDontSee('自分の商品');
    }
}
