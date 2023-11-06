<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('users')->insert([
        //     'nom_prenoms'=>"Essis Cedric",
        //     'email'=>"cedriczouzoua17@gmail.com",
        //     'telephone'=>"0103772742",
        //     'adresse'=>"Yopougon Koweit",
        //     'password'=>Hash::make('12345678X'),
        //     'statut_generique_id'=>2,
        //     'created_by'=>"Wattandoh",
        //     'role_id'=>1,
        // ]);
        DB::table('users')->insert([
            'nom_prenoms'=>"tanguy nahi",
            'email'=>"tanguynahi1@gmail.com",
            'telephone'=>"0702009174",
            'adresse'=>"Yopougon Koweit",
            'password'=>Hash::make('12345678X'),
            'statut_generique_id'=>2,
            'created_by'=>"Wattandoh",
            'role_id'=>1,
        ]);
        DB::table('users')->insert([
            'nom_prenoms'=>"tanguy man",
            'email'=>"tanguyman@gmail.com",
            'telephone'=>"0777716135",
            'adresse'=>"Yopougon Koweit",
            'password'=>Hash::make('12345678X'),
            'statut_generique_id'=>1,
            'created_by'=>"Wattandoh",
            'role_id'=>1,
        ]);
        DB::table('users')->insert([
            'nom_prenoms'=>"tanguy man",
            'email'=>"tanguy1@gmail.com",
            'telephone'=>"0161351682",
            'adresse'=>"Yopougon koute",
            'password'=>Hash::make('AZERTY123'),
            'statut_generique_id'=>1,
            'created_by'=>"Wattandoh",
            'role_id'=>1,
        ]);

    }
}
