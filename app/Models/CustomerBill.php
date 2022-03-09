<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use PhpParser\Node\Stmt\Return_;

class CustomerBill extends Model
{
    use HasFactory;
    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'prod_name',
        'quantity',
        'packet_per_box',
        'item_per_packet',
        'item_price_retail',
        'total_price',
        'date',
        'admin_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
