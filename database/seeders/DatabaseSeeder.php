<?php

namespace Database\Seeders;


use App\Models\TypeDeMarche;
use Database\Seeders\OtpSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ImageSeeder;
use Database\Seeders\BudgetSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\MarcheSeeder;
use Database\Seeders\CommuneSeeder;
use Database\Seeders\RapportSeeder;
use Database\Seeders\InterditSeeder;
use Database\Seeders\QuartierSeeder;
use Database\Seeders\AnnonceurSeeder;
use Database\Seeders\ParrainageSeeder;
use Database\Seeders\RendezvousSeeder;
use Database\Seeders\TypeDeBienSeeder;
use Database\Seeders\PublicationSeeder;
use Database\Seeders\TypeDeMarcheSeeder;
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


            InterditSeeder::class,
            RoleSeeder::class,
            StatutGenerateSeeder::class,
            ParrainageSeeder::class,
            UserActivitySeeder::class,
            TypeDeMarcheSeeder::class,
            UserSeeder::class,
            TypeDeBienSeeder::class,
            CommuneSeeder::class,
            BudgetSeeder::class,
            QuartierSeeder::class,
            AnnonceurSeeder::class,
            ClientSeeder::class,
            PublicationSeeder::class,
            ImageSeeder::class,
            RendezvousSeeder::class,
            MarcheSeeder::class,
            OtpSeeder::class,
            RapportSeeder::class,

        ]);
    }
}
