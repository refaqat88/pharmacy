<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kata extends Model
{
    use HasFactory;
    protected $table = 'katas';
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
        'image',
        'admin_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }



    public function images()
    {
        $where = array('kata_id' => $this->id);
        $images = Image::where($where)->get();
        $imageList = [];

        foreach ($images as $image){

            if (file_exists( public_path('img/upload/khata/').$image->url) && $image->url!='') {

                $imageList[] = asset('img/upload/khata/'.$image->url);
            } else {
                $imageList[] =  asset('img/upload/khata/no-image.png');
            }


        }
        return $imageList;
    }



}
