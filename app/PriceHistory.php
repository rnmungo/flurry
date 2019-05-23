<?php

namespace Flurry;

use Illuminate\Database\Eloquent\Model;

class PriceHistory extends Model
{
	protected $fillable = ['price'];


    /*****          Relaciones          *****/    
    public function product()
    {
        return $this->belongsTo('Flurry\Product');
    }


    /*****          Scopes           *****/
    public function scopeOnDate($query, $date)
    {
        return $query->whereDate('created_at', '<=', $date)
                     ->latest();
    }
}
