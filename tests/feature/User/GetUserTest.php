<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetUserTest extends TestCase
{
    protected function tearDown(): void
    {
        DB::table('user')->delete();
    }

    public function testGetUsersShouldReturnAnEmptyDataWhenThereAreNoRegisteredUsers()
    {
        $response = $this->json(
            'GET',
            '/users',
            [],
            $this->getHeaders()
        );

        $response->seeStatusCode(200);
        $response->seeJson([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'count' => 0,
                    'current_page' => 1,
                    'links' => [],
                    'per_page' => 10,
                    'total' => 0,
                    'total_pages' => 1
                ]
            ]
        ]);
    }

    public function testGetUsersShouldReturnUsersDataWhenThereAreRegisteredUser()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Foo Bar';
        $user->age = 20;
        $user->email = 'foo.bar@gmail.com';
        $user->created_at = '2019-04-22 00:00:00';
        $user->updated_at = '2019-04-22 00:00:00';

        $user->save();

        $response = $this->json(
            'GET',
            '/users',
            [],
            $this->getHeaders()
        );

        $response->seeStatusCode(200);
        $response->seeJson([
                'current_page' => 1,
                'data' => [
                    [
                        'age' => 20,
                        'created_at' => '2019-04-22 00:00:00',
                        'email' => 'foo.bar@gmail.com',
                        'id' => 1,
                        'name' => 'Foo Bar',
                        'updated_at' => '2019-04-22 00:00:00'
                    ]
                ],
                'first_page_url' => 'http://api.users.local/users?page=1',
                'from' => 1,
                'last_page' => 1,
                'last_page_url' => 'http://api.users.local/users?page=1',
                'next_page_url' => null,
                'path' => 'http://api.users.local/users',
                'per_page' => 10,
                'prev_page_url' => null,
                'to' => 1,
                'total' => 1
        ]);
    }

    public function testGetUserShouldReturnUserDataWhenValidUserIdIsPassed()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Foo Bar';
        $user->age = 20;
        $user->email = 'foo.bar@gmail.com';
        $user->created_at = '2019-04-22 00:00:00';
        $user->updated_at = '2019-04-22 00:00:00';

        $user->save();

        $response = $this->json(
            'GET',
            '/users/1',
            [],
            $this->getHeaders()
        );

        $response->seeStatusCode(200);
        $response->seeJson([
            'data' => [
                'id' => 1,
                'name' => 'Foo Bar',
                'age' => 20,
                'email' => 'foo.bar@gmail.com',
                'created_at' => '2019-04-22 00:00:00',
                'updated_at' => '2019-04-22 00:00:00'
            ]
        ]);
    }

    public function testGetUserShouldReturnUserNotFoundWhenInvalidUserIdIsPassed()
    {
        $response = $this->json(
            'GET',
            '/users/999',
            [],
            $this->getHeaders()
        );

        $response->seeStatusCode(404);
        $response->seeJson([
            'message' => 'User not found.',
            'status_code' => 404
        ]);
    }
}
