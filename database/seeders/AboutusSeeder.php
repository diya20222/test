<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aboutuses')->insert([
            'title' => 'About Company',
            'description' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'image' => 'about.jpg', 
            
        ]);
    }
}
