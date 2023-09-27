<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Marche;
use App\Models\Commune;
use App\Models\Interdit;
use App\Models\Quartier;
use App\Models\Annonceur;
// use App\Models\Rendezvous;
use App\Models\Rendezvous;
use App\Models\TypeDeBien;
use App\Models\StatutGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference',
        'description',
        'piece',
        'caution',
        'loyer',
        'commission',
        'type_de_marche_id',
        'interdit_id',
        'annonceur_id',
        'commune_id',
        'budget_id',
        'quartier_id',
        'type_de_bien_id',
        'statut_generique_id',
        'created_by',
    ];
    // public function setReferenceAttribute($value){
    //     $this->attributes['reference'] = str_slug($value);
    // }


    public function statut_generique()
    {
        return $this->belongsTo(StatutGenerique::class);
    }

    public function annonceur()
    {
        return $this->belongsTo(Annonceur::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function quartier()
    {
        return $this->belongsTo(Quartier::class);
    }

    public function marches()
    {
        return $this->hasMany(Marche::class);
    }

    public function interdit(){
        return $this->belongsTo(Interdit::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function rdvs()
    {
        return $this->hasMany(Rendezvous::class);
    }

    public function type_de_bien()
    {
        return $this->belongsTo(TypeDeBien::class);
    }

    public function type_de_marche()
    {
        return $this->belongsTo(TypeDeMarche::class);
    }

    public static function reference()
    {
        $seed = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 7) as $k) $rand .= $seed[$k];
        return $rand;
    }
}
