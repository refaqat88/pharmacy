<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kata extends Model
{
    use HasFactory;

    protected $fillable = [

        'address',
        'current_date',
        'receipt_no',
        'total_amount',
        'remaining_amount',
        'paid_amount',
        'paid_date',
        'amount_status',
        'user_id',
        'type',
        'page_no',
        'image'


    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
