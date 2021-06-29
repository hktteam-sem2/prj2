<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
         'category_order','category_name','category_desc','category_status',
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'categoryproducts';

 	public function product(){
 		return $this->hasMany('App\Product');
 	}
}
