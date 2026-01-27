<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create([
            'name'  => 'テスト太郎',
            'image' => 'test.png',
        ]);

        $sellItem = Item::factory()->create([
            'user_id' => $user->id,
            'itemname' => '出品商品',
            'image' => 'sell.png',
        ]);

        $seller = User::factory()->create();
        $buyItem = Item::factory()->create([
            'user_id' => $seller->id,
            'itemname' => '購入商品',
            'image' => 'buy.png',
        ]);

        Purchase::create([
            'user_id'   => $user->id,
            'item_id'   => $buyItem->id,
            'paymethod' => 'コンビニ払い',
            'postcode'  => '123-4567',
            'address'   => '東京都',
            'building'  => 'テストビル',
        ]);

        $response = $this->actingAs($user)->get('/mypage');

        $response->assertStatus(200);

        $response->assertSee('テスト太郎');
        $response->assertSee('storage/images/test.png');

        $response->assertSee('出品商品');
        $response->assertSee('storage/images/sell.png');
    }
}
