<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clients')->insert([
        'nom_prenoms'=>"oulassouhm regina",
        'phone1'=>"0748480894",
        'phone2'=>"0769762258",
        'sexe'=>"feminin",
        'password'=>"ok love",
        'quartier_id'=>1,
        // 'user_id'=>1,
        'commune_id'=>1,
        'statut_generique_id'=>2,
        'created_by'=>"valide",
        ]);
    }
}
