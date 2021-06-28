<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function show_spec($product_id){
        $pro_id = $product_id;
     return view('admin.show_attribute')->with(compact('pro_id'));
    }
}
