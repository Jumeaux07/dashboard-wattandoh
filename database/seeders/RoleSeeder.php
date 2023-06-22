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
            'libelle' => 'Super adminstrateur',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('roles')->insert([
            'libelle' => 'Annonceur adminstrateur',
            'created_by' => 'Wattandoh'
        ]);
        DB::table('roles')->insert([
            'libelle' => 'Client adminstrateur',
            'created_by' => 'Wattandoh'
        ]);
    }
}
