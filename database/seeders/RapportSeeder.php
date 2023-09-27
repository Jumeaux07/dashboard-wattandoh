<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RapportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rapports')->insert([
            'annonceur_id'=>1,
            'marche_id'=>1,
            'reference'=>"il va prendre",
            'nom_prenoms' =>"lionner",
            'telephone'=>"0101010101",
            'loyer'=>"AAAAA",
            'commission'=>"1000fr",
            'pourcentage'=>"100%",
            'date'=> now(),
        ]);
    }
}
