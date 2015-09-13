<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = ['site_title', 'tagline', 'email_address', 'site_banner'];
}
