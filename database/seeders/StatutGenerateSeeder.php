<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatutGenerateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statut_generiques')->insert([
            'statut' => 0,
            'description' => 'désactivé',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('statut_generiques')->insert([
            'statut' => 1,
            'description' => 'activé',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('statut_generiques')->insert([
            'statut' => 3,
            'description' => 'en attente',
            'created_by' => 'Wattandoh'
        ]);


        // destine a la table rapport

        DB::table('statut_generiques')->insert([
            'statut' => 4,
            'description' => 'en cours',
            'created_by' => 'Wattandoh'
        ]);


        DB::table('statut_generiques')->insert([
            'statut' => 7,
            'description' => 'repporté ',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('statut_generiques')->insert([
            'statut' => 6,
            'description' => 'annulé ',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('statut_generiques')->insert([
            'statut' => 8,
            'description' => 'effectué ',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('statut_generiques')->insert([
            'statut' => 5,
            'description' => 'terminé ',
            'created_by' => 'Wattandoh'
        ]);
    }
}
