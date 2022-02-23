<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = [

        'prod_name',
        'packet_per_box',
        'item_per_packet',
        'item_price_supplier',
        'item_price_retail',
        'prod_status',
        'date',
        'admin_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }



 /*   public function images()
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
    }*/



}
