<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ip_address', 'date_visitors'
    ];
    protected $primaryKey = 'id_visitors';
    protected $table = 'visitors';
}
