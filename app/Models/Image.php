<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'url', 'kata_id'
    ];
    public function kata()
    {
        return $this->belongsTo(Kata::class, 'kata_id');
    }
}
