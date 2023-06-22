<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('marches')->insert([
        'reference'=>"conclus",
        'statut_generique_id'=>1,
        'publication_id'=>1,
        'client_id'=>1,
        'rendezvous_id'=>1,
        'created_by'=>"Wattandoh",
        ]);
    }
}
