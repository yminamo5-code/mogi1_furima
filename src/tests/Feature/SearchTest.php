<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $item1 = Item::factory()->create(['itemname' => '商品A']);
        $item2 = Item::factory()->create(['itemname' => '商品B']);
        $item3 = Item::factory()->create(['itemname' => '商品C']);

        $response = $this->get('/?keyword=A');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertSee('商品A');

        $response->assertDontSee('商品B');
        $response->assertDontSee('商品C');
    }

    public function test_mylist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        Item::factory()->create(['user_id' => $user->id, 'itemname' => 'テスト商品']);

        $response = $this->get('/?keyword=テスト商品');
        $response->assertStatus(200);

        $this->assertEquals('テスト商品', session('keyword'));

        $response = $this->get('/mypage');
        $response->assertStatus(200);

        $response->assertSee('value="テスト商品"', false);
    }
}
