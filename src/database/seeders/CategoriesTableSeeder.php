<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('categories')->insert([
            ['content' => '商品の返品について', 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'サイトの使い方について', 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'その他', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
