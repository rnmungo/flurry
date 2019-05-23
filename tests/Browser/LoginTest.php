<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Flurry\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @testdox prueba. esto se ve al testear?
     * @return void
     */
    public function test_login_operator_user()
    {
        $this->browse(function (Browser $browser) {
            $operator = factory(User::class)->states('operator')->create();
            $browser->visit('/')
                    ->assertSee(config('app.name'))
                    ->assertSee('INICIAR SESIÓN')
                    ->click('.top-right a')
                    ->waitForLocation('/login')
                    ->assertPathIs('/login')
                    ->value('#name', $operator->name)
                    ->value('#password', 'secret')
                    ->click('button[type="button"]')
                    ->waitForLocation('/home')
                    ->assertPathIs('/home')
                    ->assertSee(config('app.name'))
                    ->assertSee($operator->name)
                    ->assertDontSee('Administración')
                    ->assertDontSee('Reportes')
                    ->assertSee('Ventas')
                    ->assertHasCookie(str_replace(' ', '_', $operator->name).'_session_due_date')
                    ->click('@usermenu')
                    ->pause(1000)
                    ->click('@logout-button');
        });
    }

    public function test_login_admin_user() {
        $this->browse(function (Browser $browser) {
            $admin = factory(User::class)->states('admin')->create();
            $manager = factory(User::class)->states('manager')->create();
            $supervisor = factory(User::class)->states('supervisor')->create();
            foreach ([$supervisor, $manager, $admin] as $user) {
                $browser->visit('/')
                    ->assertSee(config('app.name'))
                    ->assertSee('INICIAR SESIÓN')
                    ->click('.top-right a')
                    ->waitForLocation('/login')
                    ->assertPathIs('/login')
                    ->value('#name', $user->name)
                    ->value('#password', 'secret')
                    ->click('button[type="button"]')
                    ->waitForLocation('/home')
                    ->assertPathIs('/home')
                    ->assertSee(config('app.name'))
                    ->assertSee($user->name)
                    ->assertSee('Administración')
                    ->assertSee('Reportes')
                    ->assertSee('Ventas')
                    ->assertHasCookie(str_replace(' ', '_', $user->name).'_session_due_date')
                    ->click('@usermenu')
                    ->pause(1000)
                    ->click('@logout-button');
            }
        });
    }
}
