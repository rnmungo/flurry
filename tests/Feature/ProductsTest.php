<?php

namespace Tests\Feature;

use Flurry\Product;
use Flurry\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
  * @testdox Productos */
class ProductsTest extends TestCase
{
    /**
     * @test
     * @testdox Carga el listado de Productos.
     */
    public function it_loads_the_products_list()
    {
        $user = factory(User::class)->states('admin')->make();

        $this->actingAs($user)
             ->get('/products')
             ->assertOk()
             ->assertSee("Listado de Productos")
             ->assertViewIs("products.index");

        // $this->assertNotRepeatedQueries();
    }

    /**
     * @test
     * @testdox Carga la página de creación de Producto.
     */
    public function it_loads_new_products_page()
    {
        $user = factory(User::class)->states('manager')->make();

        $this->actingAs($user)
             ->get('/products/create')
             ->assertOk()
             ->assertSee("Alta de Producto")
             ->assertViewIs("products.create");
    }

    /** 
     * @test
     * @testdox Pueden eliminarse productos.
     */
    public function it_deletes_a_product()
    {
        $user = factory(User::class)->states('supervisor')->make();
        $product = factory(Product::class)->create();

        $this->actingAs($user)
             ->delete("api/products/{$product->id}");

        $this->assertDatabaseMissing("products", ["id" => $product->id]);
    }


    /** 
     * @test
     * @testdox No pueden verse los productos sin estar logueado.
     */
    public function guest_users_cannot_see_products()
    {
        $this->assertGuest();
        $this->get('/products')
             ->assertRedirect('/login')
             ->assertStatus(302);
    }

    /** 
     * @test
     * @testdox Usuarios no autorizados (operadores) no pueden ver los Productos.
     */
    public function unauthorized_users_cannot_see_products()
    {
        $user = factory(User::class)->states('operator')->make();

        $this->actingAs($user)
             ->get('/products')
             ->assertForbidden();
    }
}
