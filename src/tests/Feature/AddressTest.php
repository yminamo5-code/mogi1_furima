<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_address_update()
    {
        $user = User::factory()->create([
            'postcode' => '111-1111',
            'address'  => '東京都旧住所',
            'building' => '旧ビル',
        ]);

        $item = Item::factory()->create();

        $this->actingAs($user);

        $this->post(route('address.update', $item->id), [
            'postcode' => '123-4567',
            'address'  => '東京都新住所',
            'building' => '新ビル',
        ]);

        $response = $this->get(route('return.purchase', $item->id));

        $response->assertStatus(200);
        $response->assertSee('〒123-4567');
        $response->assertSee('東京都新住所');
        $response->assertSee('新ビル');
    }

    public function test_purchase_address()
    {
        $user = User::factory()->create([
            'postcode' => '123-4567',
            'address'  => '東京都テスト区',
            'building' => 'テストビル',
        ]);

        $item = Item::factory()->create();

        $response = $this->actingAs($user)->post(route('payment.store'), [
            'item_id'   => $item->id,
            'paymethod' => 'コンビニ払い',
            'postcode'  => $user->postcode,
            'address'   => $user->address,
            'building' => $user->building
        ]);

        $this->assertDatabaseHas('purchases', [
            'user_id'  => $user->id,
            'item_id'  => $item->id,
            'paymethod'=> 'コンビニ払い',
            'postcode' => '123-4567',
            'address'  => '東京都テスト区',
            'building' => 'テストビル',
        ]);
    }
}
