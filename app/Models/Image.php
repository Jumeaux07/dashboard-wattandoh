<?php

namespace App\Models;

use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes ;

    protected $fillable = [
        'url',
        'publication_id',
        'created_by',
    ];

    public function publication(){
        return $this->belongsTo(Publication::class);
    }
}
