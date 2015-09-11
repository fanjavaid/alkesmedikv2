<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['code', 'product_name', 'sku', 'price', 'discount', 'description', 'featured_image'];

    public function categories() {
    	return $this->belongsToMany('App\Category', 'products_categories', 'product_id', 'category_id');
    }

    public function attributes() {
    	return $this->belongsToMany('App\Attribute', 'products_attributes', 'product_id', 'attribute_id')->withPivot('value');
    }
}
