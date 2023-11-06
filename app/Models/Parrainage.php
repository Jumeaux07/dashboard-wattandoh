<?php

namespace App\Models;

use App\Models\Annonceur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parrainage extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'statut',
        'created_by',
    ];
    public function annonceurs(){
        return $this->hasMany(Annonceur::class);
    }
}
