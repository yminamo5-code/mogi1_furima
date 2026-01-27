<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//ログイン機能
class LoginTest extends TestCase
{
    use RefreshDatabase;

    //メールアドレスが入力されていない場合、バリデーションメッセージが表示される
    public function test_email_validation()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

        $response = $this->post('/', [
            'email' => '',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください',
        ]);
    }

    //パスワードが入力されていない場合、バリデーションメッセージが表示される
    public function test_password_validation()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

        $response = $this->post('/', [
            'email' => 'test@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください',
        ]);
    }

    //入力情報が間違っている場合、バリデーションメッセージが表示される
    public function test_user_validation()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasErrors([
            'email' => 'ログイン情報が登録されていません',
        ]);
    }

    //正しい情報が入力された場合、ログイン処理が実行される
    public function test_login_validation()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/', [
            'email' => 'test@example.com',
            'password' => 'correct-password',
        ]);

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');
    }
}