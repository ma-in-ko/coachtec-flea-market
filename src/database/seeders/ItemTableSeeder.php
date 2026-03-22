<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([

            $items = [
                'user_id' => 1,
                'name' => '腕時計',
                'price' => 15000,
                'brand' => 'Rolax',
                'description' =>'スタイリッシュなデザインのメンズ腕時計',
                'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'HDD',
                'price' => 5000,
                'brand' => '西芝',
                'description' =>'高速で信頼性の高いハードディスク',
                'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

                    $items = [
                'user_id' => 1,
                'name' =>'玉ねぎ3束',
                'price' => 300,
                'brand' => 'なし',
                'description' =>'新鮮な玉ねぎ3束セット',
                'condition' => 'やや傷や汚れあり',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'革靴',
                'price' => 4000,
                'brand' => '',
                'description' =>'クラシックなデザインの革靴',
                'condition' => '状態が悪い',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'ノートPC',
                'price' => 45000,
                'brand' => '',
                'description' =>'高性能なノートPC',
                'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'マイク',
                'price' => 8000 ,
                'brand' => 'なし',
                'description' =>'高音質のレコーディング用マイク',
                'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'ショルダーバッグ',
                'price' => 3500,
                'brand' => '',
                'description' =>'おしゃれなショルダーバッグ',
                'condition' => 'やや傷や汚れあり',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'タンブラー',
                'price' => 3500,
                'brand' => 'なし',
                'description' =>'使いやすいタンブラー',
                'condition' => '状態が悪い',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'コーヒーミル',
                'price' => 4000,
                'brand' => 'starbacks',
                'description' =>'手動のコーヒーミル',
                'condition' => '良好',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            $items = [
                'user_id' => 1,
                'name' =>'メイクセット',
                'price' => 2500,
                'brand' => '',
                'description' =>'便利なメークアップセット',
                'condition' => '目立った傷や汚れなし',
                'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
