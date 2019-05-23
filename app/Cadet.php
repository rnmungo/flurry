<?php

namespace Flurry;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Flurry\Order;

class Cadet extends Model
{
	use SoftDeletes;

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
