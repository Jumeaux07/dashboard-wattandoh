<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('publications')->insert([
            'reference'=>"0013E",
            'description'=>"propre",
            'piece'=>1,
            'caution'=>10000,
            'annonceur_id'=>1,
            'commune_id'=>1,
            'budget_id'=>1,
            'quartier_id'=>1,
            'statut_generique_id'=>1,
            'created_by'=>"Wattandoh",
        ]);
    }
}
