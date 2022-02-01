<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentKata extends Model
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
        'user_id'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
