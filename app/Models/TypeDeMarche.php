<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDeMarche extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'created_by'
    ];
}
