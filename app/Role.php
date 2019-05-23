<?php

namespace Flurry;

use Illuminate\Database\Eloquent\Model;
use Flurry\User;


class Role extends Model
{
    public function users(){
	    return $this->hasMany('Flurry\User');
	}

	protected $hidden = ['created_at', 'updated_at'];
}
