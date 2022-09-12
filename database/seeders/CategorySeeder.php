<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data=[
            ['category_name' => 'Music'], 
            ['category_name'=>'Gaming'],
            ['category_name' => 'Comedy'],
            ['category_name' => 'Sports'],
            ['category_name' => 'Animals'],
            ['category_name' => 'Education'],
            ['category_name' => 'Vehicales'],
            ['category_name' => 'Style & HowTo']
       ];
       Category::insert($data);
    }
}
