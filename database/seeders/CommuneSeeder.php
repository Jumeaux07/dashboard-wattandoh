<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('communes')->insert([
            'libelle'=>"Cocody",
            'statut_generique_id'=>1,
            'created_by'=>"Wattandoh",
        ]);
        DB::table('communes')->insert([
            'libelle'=>"Yopougon",
            'statut_generique_id'=>1,
            'created_by'=>"Wattandoh",
        ]);
        DB::table('communes')->insert([
            'libelle'=>"Koumassi",
            'statut_generique_id'=>1,
            'created_by'=>"Wattandoh",
        ]);
    }
}
