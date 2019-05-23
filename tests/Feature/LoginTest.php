<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Flurry\User;

/**
  * @testdox Login */
class LoginTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * @test
     * @testdox Carga la página de login.
     */
    public function it_visit_page_of_login()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSee('Iniciar Sesión');
    }

    /**
     * @test
     * @testdox Autentica un usuario con credenciales válidas.
     */
    public function authenticated_to_a_user()
    {
        $this->get('/login')->assertSee('Iniciar Sesión');
        $credentials = [
            "name" => "Luciano",
            "password" => "Lucho1234"
        ];

        $response = $this->post('/login', $credentials);
        $this->assertCredentials($credentials);
        // $response->assertRedirect('/home');
    }

    /**
     * @test
     * @testdox No autentica usuario sin credenciales válidas.
     */
    public function not_authenticate_to_a_user_with_credentials_invalid()
    {
        $credentials = [
            "name" => "Luciano",
            "password" => "pokemon123"
        ];

        $this->assertInvalidCredentials($credentials);
    }

    /**
     * @test
     * @testdox El nombre de usuario es requerido para autenticarse.
     */
    public function the_username_is_required_for_authenticate()
    {
        $credentials = [
            "name" => null,
            "password" => "Lucho1234"
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio.']);
    }

    /**
     * @test
     * @testdox La contraseña es requerida para autenticarse.
     */
    public function the_password_is_required_for_authenticate()
    {
        $credentials = [
            "name" => "Luciano",
            "password" => null
        ];

        $response = $this->from('/login')->post('/login', $credentials);
        $response->assertRedirect('/login')
            ->assertSessionHasErrors([
                'password' => 'El campo contraseña es obligatorio.',
            ]);
    }
}
