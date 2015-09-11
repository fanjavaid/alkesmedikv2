<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable  = ['title', 'user_id', 'parent_id', 'content', 'featured_image', 'post_type'];

    public function parent() {
    	return $this->belongsTo('App\Page', 'parent_id');
    }

    public function children() {
    	return $this->hasOne('App\Page', 'parent_id');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
