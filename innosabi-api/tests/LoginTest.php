<?php

use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this
            ->post("auth/login", [])
            ->seeStatusCode(422)
            ->seeJsonEquals([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }
}
