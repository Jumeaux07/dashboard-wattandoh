<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeDeMarcheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB:: table('type_de_marches')->insert([
            'libelle'=>"vendu",
            'created_by'=>"wattandoh",
        ]);
    }
}
