<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            // 'statut' => 0,
            'libelle' => 'Super adminstrateur',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('roles')->insert([
            'libelle' => 'Gest Annonceur ',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('roles')->insert([
            'libelle' => 'Gest Client ',
            'created_by' => 'Wattandoh'
        ]);
    }
}
