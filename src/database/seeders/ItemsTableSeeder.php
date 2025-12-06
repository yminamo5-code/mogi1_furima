<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['user_id'=>'1',
             'itemname'=>'腕時計',
             'brand'=>'Rolax',
             'image'=>'Rolax_腕時計.jpg',
             'price'=>'15000',
             'description'=>'スタイリッシュなデザインのメンズ腕時計',
             'condition'=>'良好',
            ],
           ['user_id'=>'1',
             'itemname'=>'HDD',
             'brand'=>'西芝',
             'image'=>'HDD_西芝.jpg',
             'price'=>'5000',
             'description'=>'高速で信頼性の高いハードディスク',
             'condition'=>'目立った傷や汚れなし',
            ],
           ['user_id'=>'1',
             'itemname'=>'玉ねぎ3束',
             'brand'=>null,
             'image'=>'玉ねぎ.jpg',
             'price'=>'300',
             'description'=>'新鮮な玉ねぎ3束のセット',
             'condition'=>'やや傷や汚れあり',
            ],
           ['user_id'=>'1',
             'itemname'=>'革靴',
             'brand'=>null,
             'image'=>'革靴.jpg',
             'price'=>'4000',
             'description'=>'クラシックなデザインの革靴',
             'condition'=>'状態が悪い',
            ],
           ['user_id'=>'1',
             'itemname'=>'ノートPC',
             'brand'=>null,
             'image'=>'ノートPC.jpg',
             'price'=>'45000',
             'description'=>'高性能なノートパソコン',
             'condition'=>'良好',
            ],
           ['user_id'=>'2',
             'itemname'=>'マイク',
             'brand'=>null,
             'image'=>'マイク.jpg',
             'price'=>'8000',
             'description'=>'高音質のレコーディング用マイク',
             'condition'=>'目立った傷や汚れなし',
            ],
           ['user_id'=>'2',
             'itemname'=>'ショルダーバッグ',
             'brand'=>null,
             'image'=>'ショルダーバック.jpg',
             'price'=>'3500',
             'description'=>'おしゃれなショルダーバッグ',
             'condition'=>'やや傷や汚れあり',
            ],
           ['user_id'=>'2',
             'itemname'=>'タンブラー',
             'brand'=>null,
             'image'=>'タンブラー.jpg',
             'price'=>'500',
             'description'=>'使いやすいタンブラー',
             'condition'=>'状態が悪い',
            ],
           ['user_id'=>'2',
             'itemname'=>'コーヒーミル',
             'brand'=>'Starbacks',
             'image'=>'コーヒーミル.jpg',
             'price'=>'4000',
             'description'=>'手動のコーヒーミル',
             'condition'=>'良好',
            ],
           ['user_id'=>'2',
             'itemname'=>'メイクセット',
             'brand'=>null,
             'image'=>'メイクセット.jpg',
             'price'=>'2500',
             'description'=>'便利なメイクアップセット',
             'condition'=>'目立った傷や汚れなし',
            ],
        ];
        DB::table('items')->insert($items);
    }
}
