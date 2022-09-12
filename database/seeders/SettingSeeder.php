<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'logo' => 'logo.jpg',
            'website' =>'VideoCloud@smarteyeapps.com ',
            'service_time' => '23:59', 
            'linkedln' => 'https://www.linkedin.com/groups/10411920/',
            'twitter' => 'https://twitter.com/videocloud',
            'facebook' => 'https://www.facebook.com/videocloud',
        ]);
    }
} 
