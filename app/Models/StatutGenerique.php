<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Commune;
use App\Models\Quartier;
use App\Models\Annonceur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatutGenerique extends Model
{
    use HasFactory, SoftDeletes ;

    protected $fillable = [
        'description',
        'statut',
        'created_by',
    ];
    public function communes(){
        return $this->hasMany(Commune::class);
    }

    public function quartiers(){
        return $this->hasMany(Quartier::class);
    }

    public function annoncuers(){
        return $this->hasMany(Annonceur::class);
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }
}
