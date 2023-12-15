<?php

namespace App\Console\Commands;

use Carbon\Carbon;

use App\Models\Rendezvous;
use Illuminate\Console\Command;

class UpdateRendezvousStatus extends Command
{
    protected $signature = 'update:rendezvous:statut';
    protected $description = 'Update rendezvous status based on end date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupérer les rendez-vous avec une date de fin égale à la date actuelle
        $rendezvousToUpdate = Rendezvous::whereDate('date', '=', Carbon::now()->toDateString())
            ->where('statut_generique_id', 3)
            ->get();

        // Mettre à jour le statut des rendez-vous récupérés
        foreach ($rendezvousToUpdate as $rendezvous) {
            $rendezvous->update(['statut_generique_id' => 8]);
        }

        $this->info('Rendezvous status updated successfully.');
    }
}
