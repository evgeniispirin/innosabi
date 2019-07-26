<?php

use App\Traits\JWTTrait;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use JWTTrait;

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

    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        $credentials = ['email' => 'user@test.com', 'password' => 'password'];

        $this
            ->post("auth/login", $credentials)
            ->seeStatusCode(200)
            ->seeJsonEquals([
                'token' => $this->jwt($user)
            ]);
    }
}
