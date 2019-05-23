<?php

namespace Tests\Feature;

use Flurry\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
  * @testdox Configuración del Sistema */
class SettingsTest extends TestCase
{
    /**
     * @test
     * @testdox Los admins pueden ver la pantalla Configuración del Sistema.
     */
    public function admins_can_see_the_settings_page()
    {
        $user = factory(User::class)->states('admin')->make();
        $this->actingAs($user)
             ->get('/settings')
             ->assertOk()
             ->assertSee("Configuración del Sistema")
             ->assertViewIs("settings");
    }

    /** 
     * @test
     * @testdox Usuarios no autorizados (todos menos admins) no pueden ver la Configuración.
     */
    public function unauthorized_users_cannot_see_settings_page()
    {
        $operator = factory(User::class)->states('operator')->make();
        $supervisor = factory(User::class)->states('supervisor')->make();
        $manager = factory(User::class)->states('manager')->make();

        $this->actingAs($operator)
             ->get('/settings')
             ->assertForbidden();
        $this->actingAs($supervisor)
             ->get('/settings')
             ->assertForbidden();
        $this->actingAs($manager)
             ->get('/settings')
             ->assertForbidden();
    }

    /**
     * @test
     * @testdox No puede verse la pantalla de configuración sin estar logueado.
     */
    public function guest_users_cannot_see_settings()
    {
        $this->assertGuest();
        $this->get('/settings')
             ->assertRedirect('/login')
             ->assertStatus(302);
    }
}
