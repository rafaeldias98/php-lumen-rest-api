<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteUserTest extends TestCase
{
    protected function tearDown(): void
    {
        DB::table('user')->delete();
    }

    public function testDeleteUsersShouldRemoveAnUserWhenExistingUserIdIsPassed()
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
            'DELETE',
            '/users/1',
            [],
            $this->getHeaders()
        );

        $response->seeStatusCode(204);
    }

    public function testDeleteUsersShouldReturnUserNotFoundWhenInvalidUserIdIsPassed()
    {
        $response = $this->json(
            'DELETE',
            '/users/1',
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
