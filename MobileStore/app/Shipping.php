<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'shipping_name', 'shipping_phone' , 'shipping_address' , 'shipping_notes' , 'shipping_method'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'shipping';
}
