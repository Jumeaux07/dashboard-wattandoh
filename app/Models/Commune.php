<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Quartier;
use App\Models\Annonceur;
use App\Models\StatutGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commune extends Model
{
    use HasFactory, SoftDeletes ;
    protected $fillqble =[
        'libelle',
        'statut_generique_id',
        'created_by',
    ];

    public function statut_generique(){
        return $this->belongsTo(StatutGenerique::class);
    }

    public function quartiers(){
        return $this->hasMany(Quartier::class);
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public function annonceurs(){
        return $this->hasMany(Annonceur::class);
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }

}
