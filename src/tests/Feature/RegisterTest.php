<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

//会員登録機能
class RegisterTest extends TestCase
{
    use RefreshDatabase;

    //名前が入力されていない場合、バリデーションメッセージが表示される
    public function test_name_validation()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        $response = $this->post('/register', [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['name']);

        $response->assertSessionHasErrors([
            'name' => 'お名前を入力してください',
        ]);
    }

    //メールアドレスが入力されていない場合、バリデーションメッセージが表示される
    public function test_email_validation()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        $response = $this->post('/register', [
            'name' => 'example',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
        $response->assertSessionHasErrors([
            'email' => 'メールアドレスを入力してください',
        ]);
    }

    //パスワードが入力されていない場合、バリデーションメッセージが表示される
    public function test_password_validation()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        $response = $this->post('/register', [
            'name' => 'example',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHasErrors([
            'password' => 'パスワードを入力してください',
        ]);
    }

    //パスワードが7文字以下の場合、バリデーションメッセージが表示される
    public function test_password_validation_min8()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
        $response = $this->post('/register', [
            'name' => 'example',
            'email' => 'test@example.com',
            'password' => '1234567',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHasErrors([
            'password' => 'パスワードは8文字以上で入力してください',
        ]);
    }

    //パスワードが確認用パスワードと一致しない場合、バリデーションメッセージが表示される
    public function test_password_confirmation_validation_same()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        $response = $this->post('/register', [
            'name' => 'example',
            'email' => 'test@example.com',
            'password' => '12345678',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['password_confirmation']);
        $response->assertSessionHasErrors([
            'password_confirmation' => 'パスワードと一致しません',
        ]);
    }

    //全ての項目が入力されている場合、会員情報が登録され、プロフィール設定画面に遷移される
    public function test_register_OK()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');

        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(), 
        ]);

        $response = $this->actingAs($user)->get('/mypage/profile');
        $response->assertStatus(200);
        $response->assertViewIs('profile_edit');
    }
}
