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
    }
}
