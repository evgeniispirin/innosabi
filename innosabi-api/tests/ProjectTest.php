<?php

use App\Project;
use App\Traits\JWTTrait;
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    use JWTTrait;

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

    public function testProjectsListedCorrectly()
    {
        $first_project = factory(Project::class)->create([
            'name' => "First Name",
            'description' => "First Description"
        ]);

        $second_project = factory(Project::class)->create([
            'name' => "Second Name",
            'description' => "Second Description"
        ]);


        $user = factory(User::class)->create([
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        $jsonBody = [
            'token' => $this->jwt($user)
        ];

        $this
            ->json('GET', '/api/projects', $jsonBody)
            ->seeStatusCode(200)
            ->seeJsonEquals([
                [
                    'created_at' => $first_project->created_at->format('Y-m-d H:i:s'),
                    'description' => 'First Description',
                    'id' => 1,
                    'name' => 'First Name',
                    ],
                [
                    'created_at' => $second_project->created_at->format('Y-m-d H:i:s'),
                    'description' => 'Second Description',
                    'id' => 2,
                    'name' => 'Second Name',
                    ]
            ]);
    }

    public function testProjectCreatedCorrectly()
    {
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        $jsonBody = [
            'token' => $this->jwt($user),
            'name' => 'Lorem',
            'description' => 'Ipsum',
        ];

        $this
            ->post("/api/projects", $jsonBody)
            ->seeStatusCode(201)
            ->seeJsonEquals([
                'created_at' => date('Y-m-d H:i:s'),
                'description' => 'Ipsum',
                'id' => 1,
                'name' => 'Lorem',
            ]);
    }

    public function testProjectUpdatedCorrectly()
    {
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        $project = factory(Project::class)->create([
            'name' => 'First Project',
            'description' => 'Project Description',
        ]);

        $jsonBody = [
            'token' => $this->jwt($user),
            'name' => 'Updated Project',
            'description' => 'Updated Description',
        ];

        $this->json('PUT', '/api/projects/' . $project->id, $jsonBody)
            ->seeStatusCode(200)
            ->seeJsonEquals([
                'created_at' => $project->created_at->format('Y-m-d H:i:s'),
                'description' => 'Updated Description',
                'id' => 1,
                'name' => 'Updated Project',
            ]);
    }

    public function testProjectDeletedCorrectly()
    {
        $user = factory(User::class)->create([
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        $project = factory(Project::class)->create([
            'name' => 'Project',
            'description' => 'Project Description',
        ]);

        $jsonBody = [
            'token' => $this->jwt($user)
        ];

        $this
            ->json('DELETE', '/api/projects/' . $project->id, $jsonBody)
            ->seeStatusCode(200)
            ->seeJsonEquals(['successful' => 'The project deleted.']);
    }
}
