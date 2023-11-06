<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParrainageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('parrainages')->insert([
            'statut' => 1,
            'description' => 'Parrainé',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('parrainages')->insert([
            'statut' => 2,
            'description' => 'Parrain',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('parrainages')->insert([
            'statut' => 3,
            'description' => 'Aucun',
            'created_by' => 'Wattandoh'
        ]);
    }
}
