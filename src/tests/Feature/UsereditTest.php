<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UsereditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create([
            'name'      => '既存ユーザー',
            'postcode'  => '123-4567',
            'address'   => '東京都テスト区',
            'building'  => 'テストビル',
            'image'     => 'profile.png',
        ]);

        $response = $this->actingAs($user)
            ->get(route('profile'));

        $response->assertStatus(200);

        $response->assertSee('既存ユーザー');
        $response->assertSee('123-4567');
        $response->assertSee('東京都テスト区');
        $response->assertSee('テストビル');
        $response->assertSee('storage/images/profile.png');
    }
}
