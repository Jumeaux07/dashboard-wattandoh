<?php

namespace App\Models;

use App\Models\User;
use App\Models\Marche;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Rendezvous;
use App\Models\StatutGenerique;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\Client as Authenticatable;

class Client extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom_prenoms',
        'phone1',
        'phone2',
        'sexe',
        'password',
        'quartier_id',
        // 'user_id',
        'commune_id',
        'statut_generique_id',
        'created_by',
    ];

    public function statut_generique(){
        return $this->belongsTo(StatutGenerique::class);
    }

    public function quartier(){
        return $this->belongsTo(Quartier::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commune(){
        return $this->belongsTo(Commune::class);
    }

    public function marche(){
        return $this->hasMany(Marche::class);
    }

    // public function rdv(){
    //     return $this->belongsToMany(Rendezvous::class,'rendezvouses');
    // }
    public function rdv(){
        return $this->hasMany(Rendezvous::class);
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
