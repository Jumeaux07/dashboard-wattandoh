<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Rapport;
use App\Models\Rendezvous;
use App\Models\Publication;
use App\Models\StatutGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marche extends Model
{
    use HasFactory, SoftDeletes ;

    protected $fillable = [
        'reference',
        'statut_generique_id',
        'publication_id',
        'client_id',
        'rendezvous_id',
        'created_by',
    ];


    public function statut_generique(){
        return $this->belongsTo(StatutGenerique::class);
    }

    public function publication(){
        return $this->belongsTo(Publication::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function rdv(){
        return $this->belongsTo(Rendezvous::class,'rendezvous_id','id');
    }
    // public function rdv(){
    //     return $this->belongsTo(Rendezvous::class);
    // }
    public function rapports(){
        return $this->hasMany(Rapport::class);
    }




    public static function reference(){
        $seed = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 7) as $k) $rand .= $seed[$k];
        return $rand;
    }
}
