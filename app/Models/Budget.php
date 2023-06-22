<?php

namespace App\Models;

use App\Models\StatutGenerique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'min',
        'max',
        'statut_generique_id',
        'created_by',
    ];

    public function statut_generique(){
        return $this->belongsTo(StatutGenerique::class);
    }

    public function publications(){
        return $this->hasMany(Publication::class);
    }
}
