<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Products extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/products';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
                ->assertTitle(config('app.name', 'Flurry').' - Productos')
                ->assertSee("Listado de Productos")
                ->assertSeeLink("Nuevo");
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@new'    => 'a[href="/products/create"]',
            '@search' => '#searchText',
        ];
    }
}
