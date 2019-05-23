<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Flurry\Taste;
use Flurry\User;

/**
  * @testdox Gustos */
class TastesTest extends TestCase
{
    /**
     * @test
     * @testdox Carga el listado de Gustos.
     */
    public function it_loads_the_tastes_list()
    {
        $user = factory(User::class)->states('admin')->make();

        $this->actingAs($user)
             ->get('/tastes')
             ->assertOk()
             ->assertSee("Listado de Gustos")
             ->assertViewIs("tastes.index");

        // $this->assertNotRepeatedQueries();
    }

    /**
     * @test
     * @testdox Carga la página de creación de Gusto.
     */
    public function it_loads_new_tastes_page()
    {
        $user = factory(User::class)->states('manager')->make();

        $this->actingAs($user)
             ->get('/tastes/create')
             ->assertOk()
             ->assertSee("Alta de Gusto")
             ->assertViewIs("tastes.create");
    }
}
