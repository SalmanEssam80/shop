<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = ['html','css','javascript','php','python'];

        foreach($list as $i){
            Category::create([
                'name' => $i,
                'description' => 'this is a simple category just for testing my skills',
                'thumbnail' => 'storage/category.jpg',
            ]);
        }
    }
}
