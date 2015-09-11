<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'user_id', 'content', 'featured_image', 'post_type'];

    //
    public function categories() {
    	return $this->belongsToMany('App\Category', 'posts_categories', 'post_id', 'category_id');
    }

    //
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
