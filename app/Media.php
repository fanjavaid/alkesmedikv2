<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'medias';
    protected $fillable = ['title', 'path', 'url', 'description'];

    public function categories() {
    	return $this->belongsToMany('App\Category', 'medias_categories', 'media_id', 'category_id');
    }
}
