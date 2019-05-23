<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Tests\Browser\Pages\Products as ProductsPage;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Flurry\Product;

class ProductsTest extends DuskTestCase
{
    /**
     * Se puede crear un producto mediante navegador.
     *
     * @return void
     */
    public function test_create_new_product()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->pause(1000)
                    ->visit(new ProductsPage)
                    ->click("@new")
                    ->waitForLocation('/products/create');
        });
    }

    /**
     * Se puede filtrar un producto existente en el listado de productos.
     *
     * @return void
     */
    public function test_search_product()
    {
        $product = factory(Product::class)->create();

        $this->browse(function (Browser $browser) use ($product) {
            $browser->loginAs(1)
                    ->pause(1000)
                    ->visit(new ProductsPage)
                    ->type("@search", $product->name)
                    ->assertSee($product->description);
        });
    }

    /**
     * Se puede editar un producto existente.
     *
     * @return void
     */
    public function test_modify_product()
    {
        $product = factory(Product::class)->create();

        $this->browse(function (Browser $browser) use ($product) {
            $browser->loginAs(1)
                    ->pause(1000)
                    ->visit(new ProductsPage)
                    ->type("@search", $product->name)
                    ->click("@new")     # to do: reemplazar por boton edicion correspondiente
                    ->waitForLocation('/products/'.$product->id.'/edit');
        });
    }

    /**
     * Se puede eliminar un producto existente.
     *
     * @return void
     */
    public function test_delete_product()
    {
        $product = factory(Product::class)->create();

        $this->browse(function (Browser $browser) use ($product) {
            $browser->loginAs(1)
                    ->pause(1000)
                    ->visit(new ProductsPage)
                    ->type("@search", $product->name);
                    # to do: clickear boton eliminar correspondiente y checkear que no existe mas el registro
        });
    }

}
