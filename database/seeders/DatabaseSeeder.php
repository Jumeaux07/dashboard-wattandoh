<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\BudgetSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\MarcheSeeder;
use Database\Seeders\CommuneSeeder;
use Database\Seeders\QuartierSeeder;
use Database\Seeders\AnnonceurSeeder;
use Database\Seeders\RendezvousSeeder;
use Database\Seeders\TypeDeBienSeeder;
use Database\Seeders\PublicationSeeder;
use Database\Seeders\UserActivitySeeder;
use Database\Seeders\StatutGenerateSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatutGenerateSeeder::class,
            CommuneSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            BudgetSeeder::class,
            QuartierSeeder::class,
            ClientSeeder::class,
            AnnonceurSeeder::class,
            TypeDeBienSeeder::class,
            PublicationSeeder::class,
            RendezvousSeeder::class,
            MarcheSeeder::class,
            UserActivitySeeder::class,
            ImageSeeder::class,
        ]);
    }
}
