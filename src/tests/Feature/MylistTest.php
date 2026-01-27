<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Like;
use App\Models\Purchase;


class MylistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_like()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $item1 = Item::factory()->create(['itemname' => '表示', 'user_id' => $user2->id]);
        $item2 = Item::factory()->create(['itemname' => '非表示', 'user_id' => $user2->id]);

        $user1->likes()->create(['item_id' => $item1->id]);

        $response = $this->actingAs($user1)->get('/?tab=mylist');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertSee('表示');
        $response->assertDontSee('非表示');
    }

    public function test_sold()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create(['itemname' => '商品A', 'user_id' => $user->id]);
        $user->likes()->create(['item_id' => $item->id]);
        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertSee('SOLD'); 
    }

    public function test_unverified()
    {
        $seller = User::factory()->create();
        $item1 = Item::factory()->create(['itemname' => '商品A', 'user_id' => $seller->id]);
        $item2 = Item::factory()->create(['itemname' => '商品B', 'user_id' => $seller->id]);

        $response = $this->get('/?tab=mylist');
        $response->assertStatus(200);
        $response->assertViewIs('index');
        
        $response->assertDontSee('商品A');
        $response->assertDontSee('商品B');
    }
}
