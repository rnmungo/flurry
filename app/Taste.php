<?php

namespace Flurry;

use Illuminate\Database\Eloquent\Model;

class Taste extends Model
{
    protected $fillable = [
        'name', 'description', 'color', 'white_text',
    ];

}
