<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Annonceur;
use App\Models\Publication;
use App\Models\StatutGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rendezvous extends Model
{
    use HasFactory, SoftDeletes ;

    protected $fillable = [
        'reference',
        'date',
        'publication_id',
        'client_id',

        'annonceur_id',

        'statut_generique_id',
        'created_by',
    ];
    public function statut_generique()
    {
        return $this->belongsTo(StatutGenerique::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function annonceur()
    {
        return $this->belongsTo(Annonceur::class);
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
    public static function reference(){
        $seed = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 7) as $k) $rand .= $seed[$k];
        return $rand;
    }
}
