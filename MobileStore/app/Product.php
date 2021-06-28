<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_name', 'category_id' , 'brand_id' , 'product_desc' , 'product_price' , 'product_image' , 'product_quantity', 'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'products';

    public function pro_details(){
       return $this->hasOne('App\Pro_details','product_id');
    }
    public function comment(){
        return $this->hasMany('App\Comment');
    }

}
