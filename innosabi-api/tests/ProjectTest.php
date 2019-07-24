<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    /**
     * /projects [GET]
     */
    public function testShouldReturnAccessDeniedError(){

        $this
            ->get("/api/projects", [])
            ->seeStatusCode(401)
            ->seeJsonEquals([
            'error' => 'Access denied! A token is required.'
        ]);
    }
}
