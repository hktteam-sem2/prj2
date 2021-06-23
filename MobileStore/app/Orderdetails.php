<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_code', 'product_id' , 'product_name' , 'product_price' , 'product_sales_quantity' , 'product_coupon'
    ];
    protected $primaryKey = 'order_details_id';
    protected $table = 'orderdetails';

    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
