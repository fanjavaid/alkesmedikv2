<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $fillable = ['attribute_name', 'type', 'description'];

    public function products() {
    	return $this->belongsToMany('App\Product', 'products_attributes', 'attribute_id', 'product_id')->withPivot('value');;
    }
}
