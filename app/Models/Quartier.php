<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Commune;
use App\Models\Annonceur;
use App\Models\Publication;
use App\Models\StatutGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quartier extends Model
{
    use HasFactory, SoftDeletes ;

    protected $fillable = [
        'libelle',
        'commune_id',
        'statut_generique_id',
        'created_by',
    ];

    public function statut_generique(){
        return $this->belongsTo(StatutGenerique::class);
    }

    public function commune(){
        return $this->belongsTo(Commune::class);
    }

    public function publications(){
        return $this->belongsTo(Publication::class);
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public function annonceurs(){
        return $this->hasMany(Annonceur::class);
    }


}
