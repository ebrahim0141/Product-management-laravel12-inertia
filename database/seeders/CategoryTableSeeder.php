<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        Category::insert([

            ['name'=>'Men','user_id'=>1],
            ['name'=>'Women','user_id'=>1],
            ['name'=>'Child','user_id'=>1],
            ['name'=>'Animal','user_id'=>1],
            ['name'=>'Medicine','user_id'=>1],
            
        ]);
    }
}
