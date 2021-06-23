<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'slider_name','slider_image','slider_desc','slider_status',
    ];
    protected $primaryKey = 'slider_id';
    protected $table = 'slider';
}
