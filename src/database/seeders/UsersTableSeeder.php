<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'田中一郎',
             'email'=>'aa@yy',
             'password'=>bcrypt('123456789'),
             'image'=>'ハートロゴ_ピンク.png',
             'postcode'=>'123-4567',
             'address'=>'東京都',
             'building'=>'コーポ◯◯',
            ],
            ['name'=>'佐藤二朗',
             'email'=>'bb@yy',
             'password'=>bcrypt('123456789'),
             'image'=>'ふきだしロゴ.png',
             'postcode'=>'234-5678',
             'address'=>'岡山県',
             'building'=>'マンション✕✕',
            ],
            ['name'=>'三郎',
             'email'=>'cc@yy',
             'password'=>bcrypt('123456789'),
             'image'=>'COACHTECHヘッダーロゴ.png',
             'postcode'=>'cc@yy',
             'address'=>'北海道',
             'building'=>'アパート△△',
            ],
        ];
        DB::table('users')->insert($users);
    }
}
