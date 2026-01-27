<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_comment()
    {
        $user = User::factory()->create();

        $item = Item::factory()->create();

        $beforeCount = Comment::count();

        $response = $this->actingAs($user)->post(route('comment'), [
            'item_id' => $item->id,
            'comment' => 'テストコメントです',
        ]);

        $this->assertEquals($beforeCount + 1, Comment::count());

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメントです',
        ]);
    }

    public function test_nouser_comment(){
        $item = Item::factory()->create();

        $response = $this->post(route('comment'), [
            'item_id' => $item->id,
            'comment' => '未ログインコメント',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('comments', [
            'comment' => '未ログインコメント',
        ]);
    }

    public function test_nocomment(){
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user)->post(route('comment'), [
            'item_id' => $item->id,
            'comment' => ''
        ]);

        $response->assertSessionHasErrors(['comment']);

        $this->assertDatabaseMissing('comments', [
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_255_comment(){
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $response = $this->actingAs($user)->post(route('comment'), [
            'item_id' => $item->id,
            'comment' => str_repeat('あ', 256),
        ]);

        $response->assertSessionHasErrors(['comment']);

        $this->assertDatabaseMissing('comments', [
            'item_id' => $item->id,
            'user_id' => $user->id,
        ]);
    }

}
