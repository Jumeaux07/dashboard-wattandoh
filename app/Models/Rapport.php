<?php

namespace App\Models;

use App\Models\Marche;
use App\Models\Annonceur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rapport extends Model
{
    use HasFactory;


    protected $fillable =[
        'annonceur_id',
        'marche_id',
        'reference',
        'nom_prenoms',
        'telephone',
        'loyer',
        'commission',
        'pourcentage',
        'date',
    ];



    public function marche(){
        return $this->belongsTo(Marche::class);
    }
    public function annonceur(){
        return $this->belongsTo(Annonceur::class);
    }
}
