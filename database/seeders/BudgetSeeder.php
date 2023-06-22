<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('budgets')->insert([
        'min'=>50000,
        'max'=>100000,
        'statut_generique_id'=>1,
        'created_by'=>"wattandoh",
        ]);
        DB::table('budgets')->insert([
        'min'=>100000,
        'max'=>150000,
        'statut_generique_id'=>1,
        'created_by'=>"wattandoh",
        ]);
    }
}
