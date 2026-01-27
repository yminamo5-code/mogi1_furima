<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;

class SoldTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_purchase()
    {
        $user = User::factory()->create([
            'postcode' => '123-4567',
            'address'  => '東京都テスト区',
            'building' => 'テストビル',
        ]);

        $item = Item::factory()->create([
            'price' => 1000,
        ]);

        $response = $this->actingAs($user)->post(route('payment.store'), [
            'item_id'   => $item->id,
            'paymethod' => 'コンビニ払い',
            'postcode'  => $user->postcode,
            'address'   => $user->address,
            'building'  => $user->building,
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('purchases', [
            'user_id'   => $user->id,
            'item_id'   => $item->id,
            'paymethod' => 'コンビニ払い',
        ]);
    }

    public function test_purchase_sold()
    {
        $user = User::factory()->create([
            'postcode' => '123-4567',
            'address'  => '東京都テスト区',
            'building' => 'テストビル',
        ]);

        $item = Item::factory()->create([
            'price' => 1000,
        ]);

        $response = $this->actingAs($user)->post(route('payment.store'), [
            'item_id'   => $item->id,
            'paymethod' => 'コンビニ払い',
            'postcode'  => $user->postcode,
            'address'   => $user->address,
            'building'  => $user->building,
        ]);

        $response = $this->get('/');
        $response->assertSee('SOLD');
    }

    public function test_profile()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'itemname' => 'テスト商品',
            'price' => 1000,
        ]);

        Purchase::create([
            'user_id'   => $user->id,
            'item_id'   => $item->id,
            'paymethod' => 'コンビニ払い',
            'postcode'  => '123-4567',
            'address'   => '東京都テスト区',
            'building'  => 'テストビル',
        ]);

        $response = $this->actingAs($user)->get('/mypage?page=buy');

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
    }
}
