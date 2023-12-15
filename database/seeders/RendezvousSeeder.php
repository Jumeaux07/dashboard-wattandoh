<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RendezvousSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rendezvouses')->insert([
        'reference'=>"demain",
        'date'=> now(),
        'publication_id'=>1,
        'client_id'=>1,
        'annonceur_id'=>1,
        'statut_generique_id'=>3,
        'created_by'=>"Wattandoh",
        ]);
    }
}
