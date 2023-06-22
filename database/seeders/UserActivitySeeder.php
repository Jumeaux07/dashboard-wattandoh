<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_activities')->insert([
            'user_id'=>1,
            'ip'=>"1234AZER",
            'module'=>"admin clients",
            'navigator'=>"chrome",
            'action'=>"activer",
            'pays'=>"cote d'ivoire",
            'codepays'=>"+225",
            'url'=>"https//www.wattandoh.com",
        ]);
    }
}
