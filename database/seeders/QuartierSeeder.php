<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class QuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('quartiers')->insert([
        'libelle'=>"deux plateaux",
        'commune_id'=>1,
        'statut_generique_id'=>1,
        'created_by'=>"Wattandoh",
        ]);
        DB::table('quartiers')->insert([
        'libelle'=>"Koweit",
        'commune_id'=>2,
        'statut_generique_id'=>1,
        'created_by'=>"Wattandoh",
        ]);
    }
}
