<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnnonceurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('annonceurs')->insert([
            'nom_prenoms'=>"koffi jean",
            'phone1'=>"01020304",
            'phone2'=>"09080706",
            'sexe'=>"M",
            'parrain'=>"P",

            'password'=>bcrypt('1234567'),
            'user_id'=>1,
            'quartier_id'=>1,
            'commune_id'=>1,
            'statut_generique_id'=>1,
            'created_by'=>"valide",
        ]);
        DB::table('annonceurs')->insert([
            'nom_prenoms'=>"Kouadio jean",
            'phone1'=>"01020304",
            'phone2'=>"09080706",
            'sexe'=>"M",
            'parrain'=>"N",
            'password'=>bcrypt('1234567'),
            'user_id'=>1,
            'quartier_id'=>1,
            'commune_id'=>1,
            'statut_generique_id'=>2,
            'created_by'=>"Vattandoh",
        ]);
    }
}
