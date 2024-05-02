<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryComponent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('component_categories')->insert([
            ['title_category_components' => 'Материнская плата'],
            ['title_category_components' => 'Жесткий диск'],
            ['title_category_components' => 'ОЗУ'],
            ['title_category_components' => 'SSD диск'],
            ['title_category_components' => 'Блок питания'],
            ['title_category_components' => 'Видеокарта '],
            ['title_category_components' => 'Процессор'],
        ]);
    }
}
