<?php

namespace Tests;

use Flurry\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DetectRepeatedQueries;

    protected function setUp(): void
    {
        parent::setUp();
        $this->enableQueryLog();
    }

    protected function tearDown(): void
    {
        $this->flushQueryLog();
        parent::tearDown();
    }



    // Código copiado pendiente de probar
    protected function createUser(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }

    protected function createAdmin()
    {
        return tap(factory(User::class)->create(), function ($user) {
            // assign role 'admin' to $user
            $user->assign('admin');
        });
    }

    protected function assertDatabaseEmpty($table, $connection = null)
    {
        $total = $this->getConnection($connection)->table($table)->count();
        $this->assertSame(0, $total, sprintf(
            "Failed asserting the table [%s] is empty. %s %s found.", $table, $total, str_plural('row', $total)
        ));
    }
}