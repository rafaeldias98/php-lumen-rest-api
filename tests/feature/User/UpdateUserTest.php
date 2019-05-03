<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateUserTest extends TestCase
{
    protected function tearDown(): void
    {
        DB::table('user')->delete();
    }

    public function testUpdateUserShouldChangeUserDataWhenValidDataIsPassed()
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
            'PATCH',
            '/users/1',
            ['age' => 25],
            $this->getHeaders()
        );

        $response->seeStatusCode(204);
        $this->seeInDatabase('user', ['age' => 25]);
    }

    /**
     * @dataProvider invalidUserDataProvider
     */
    public function testUpdateUserShouldNotChangeUserDataWhenInvalidDataIsPassed(
        $data,
        $expectedJsonError
    ) {
        $user = new User();
        $user->id = 1;
        $user->name = 'Foo Bar';
        $user->age = 20;
        $user->email = 'foo.bar@gmail.com';
        $user->created_at = '2019-04-22 00:00:00';
        $user->updated_at = '2019-04-22 00:00:00';

        $user->save();

        $response = $this->json(
            'PATCH',
            '/users/1',
            $data,
            $this->getHeaders()
        );

        $response->seeStatusCode(422);
        $response->seeJson($expectedJsonError);
        $this->seeInDatabase('user', ['age' => 20]);
    }

    public function invalidUserDataProvider()
    {
        return [
            'Invalid user name type' => [
                'Data' => [
                    'name' => 1
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'name' => [
                            'The name must be a string.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
            'Invalid user age type' => [
                'Data' => [
                    'age' => 'a'
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'age' => [
                            'The age must be a number.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
            'Invalid max user age' => [
                'Data' => [
                    'age' => 100
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'age' => [
                            'The age may not be greater than 99.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
            'Invalid min user age' => [
                'Data' => [
                    'age' => -1
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'age' => [
                            'The age must be at least 0.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
            'Invalid user email' => [
                'Data' => [
                    'email' => 'foo.bar'
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'email' => [
                            'The email must be a valid email address.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
        ];
    }
}
