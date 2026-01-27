<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;


class ItemDetail_Test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_itemdetail_show()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create([
            'image' => 'test.jpg',
            'itemname' => 'テスト商品',
            'brand' => 'テストブランド',
            'price' => 12345,
            'description' => 'これはテスト用の商品です。',
            'condition' => '新品',
        ]);

        $category = Category::factory()->create(['category' => '家電']);
        $item->categories()->attach($category);

        $comment = Comment::factory()->create([
            'item_id' => $item->id,
            'user_id' => $user->id,
            'comment' => 'テストコメント',
        ]);

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);

        $response->assertSee('テスト商品');
        $response->assertSee('テストブランド');
        $response->assertSee('12,345');
        $response->assertSee('これはテスト用の商品です。');
        $response->assertSee('新品');

        $response->assertSee('storage/images/test.jpg', false);

        $response->assertSee($category->category);

        $response->assertSee($user->name);
        $response->assertSee($comment->comment);

        $response->assertSee((string) $item->likes()->count());
        $response->assertSee((string) $item->comments()->count());
    }

    public function test_itemdetail_categories()
    {
        $item = Item::factory()->create();
        $category1 = Category::factory()->create(['category' => '家電']);
        $category2 = Category::factory()->create(['category' => 'ゲーム']);
        $item->categories()->attach([$category1->id, $category2->id]);

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);

        $response->assertSee('家電');
        $response->assertSee('ゲーム');
    }
}
