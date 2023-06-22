<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeDeBienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('type_de_biens')->insert([
        'libelle'=>"villa",
        'statut_generique_id'=>1,
        'created_by'=>"Wattandoh",
        ]);
        DB::table('type_de_biens')->insert([
        'libelle'=>"magasin",
        'statut_generique_id'=>1,
        'created_by'=>"Wattandoh",
        ]);
    }
}
