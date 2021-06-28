<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro_details extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'speci_screen','speci_os','speci_frontcam','speci_backcam','speci_chip','speci_ram','speci_memory','speci_sim','speci_battery','product_id'
    ];
    protected $primaryKey = 'spec_id';
    protected $table = 'pro_details';
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
