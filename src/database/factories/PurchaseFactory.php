<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Item;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id'   => Item::factory(),
            'user_id'   => User::factory(),
            'paymethod' => 'クレジットカード',
            'postcode'  => '123-4567',
            'address'   => '東京都テスト区',
            'building'  => 'テストビル',
        ];
    }
}
