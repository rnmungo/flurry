<?php

namespace Flurry\Listeners;

use Flurry\Events\ProductSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Flurry\PriceHistory;

class UpdatePriceHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Cuando se guarda un producto y su precio cambió, se guarda el respectivo
     * PriceHistory asociado al producto.
     *
     * @param  ProductSaved  $event
     * @return void
     */
    public function handle(ProductSaved $event)
    {
        $product = $event->product;
        if ($product->isDirty('price')) {
            $history = new PriceHistory(['price' => $product->price]);
            $product->price_histories()->save($history);
        }
    }
}
