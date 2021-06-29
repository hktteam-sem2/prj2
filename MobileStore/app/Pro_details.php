<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pro_details extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'speci_screen','speci_os','speci_frontcam','speci_backcam','speci_chip','speci_ram','speci_memory','speci_sim','speci_battery','product_id'
    ];
    protected $primaryKey = 'speci_id';
    protected $table = 'pro_details';
}
