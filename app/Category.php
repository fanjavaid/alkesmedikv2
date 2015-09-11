<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['category_name', 'description'];

    public function post() {
    	return $this->belongsToMany('App\Post', 'posts_categories', 'category_id', 'post_id');
    }

    public function media() {
    	return $this->belongsToMany('App\Media', 'medias_categories', 'category_id', 'media_id');
    }

    public function products() {
    	return $this->belongsToMany('App\Product', 'products_categories', 'category_id', 'product_id');
    }
}
