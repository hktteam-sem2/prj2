<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'gallery_name', 'gallery_image','product_id',
    ];
    protected $primaryKey = 'gallery_id';
    protected $table = 'gallery';
    public function product_gal()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
