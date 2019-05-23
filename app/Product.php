<?php

namespace Flurry;

use Illuminate\Database\Eloquent\Model;
use Flurry\PriceHistory;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'alias',
        'hasTastes',
        'max_tastes',
        'price',
        'weight',
    ];


    /*****          Accesores           *****/
	public function getPictureAttribute($value){
    	if (!$value){
    		return config('ourconfig.products.default_image');
    	}
    	return $value;
    }


    /*****          Funciones           *****/
    /* Determina si el producto realmente tiene una imagen asociada. */
    public function hasPicture(){
        return boolval($this->getAttributes() && $this->getAttributes()['picture']);
    }

    /**
     * Precio del artículo en una determina fecha.
     * Nulo si el artículo aún no existía.
     *
     * @param  DateTime   $date
     * @return float|null
     **/
    public function getPriceOnDate($date) {
        if ($this->created_at->toDateString() > $date)
            return null;
        else
            return $this->price_histories()
                        ->onDate($date)
                        ->value('price');
    }


    /*****       Mapeo de Eventos       *****/
    protected $dispatchesEvents = [
        'saved' => \Flurry\Events\ProductSaved::class,
    ];


    /*****          Relaciones          *****/
    public function price_histories()
    {
        return $this->hasMany('Flurry\PriceHistory');
    }


    /*****          Scopes           *****/
    public function scopeOpen($query)
    {
        return $query->whereNull('closed')->orWhere('closed', 0);
    }
}
