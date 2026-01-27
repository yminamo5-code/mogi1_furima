<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class SellTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $categories = Category::factory()->count(2)->create();

        $response = $this->post(route('sell.store'), [
            'image'       => UploadedFile::fake()->image('item.jpg'),
            'categories'  => $categories->pluck('id')->toArray(),
            'condition'   => '良好',
            'itemname'    => 'テスト商品',
            'brand'       => 'テストブランド',
            'description' => 'テスト用の商品説明',
            'price'       => 1000,
        ]);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('items', [
            'user_id'   => $user->id,
            'itemname'  => 'テスト商品',
            'condition' => '良好',
            'price'     => 1000,
        ]);

        $item = Item::first();

        foreach ($categories as $category) {
            $this->assertDatabaseHas('category_item', [
                'item_id'     => $item->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
