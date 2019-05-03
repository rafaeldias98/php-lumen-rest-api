<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostUserTest extends TestCase
{
    protected function tearDown(): void
    {
        DB::table('user')->delete();
    }

    public function testPostUserShouldCreateANewUserWhenValidDataIsPassed()
    {
        $response = $this->json(
            'POST',
            '/users',
            [
                'name' => 'Foo Bar',
                'age' => 20,
                'email' => 'foo.bar@gmail.com'
            ],
            $this->getHeaders()
        );

        $response->seeStatusCode(201);
        $response->seeJsonStructure([
            'data' => [
                'id',
                'name',
                'age',
                'email',
                'created_at',
                'updated_at'
            ],
        ]);
    }

    /**
     * @dataProvider missingUserDataProvider
     */
    public function testPostUserShouldReturnErrorsWhenMissingDataIsPassed(
        $data,
        $expectedJsonError
    ) {
        $response = $this->json(
            'POST',
            '/users',
            $data,
            $this->getHeaders()
        );

        $response->seeStatusCode(422);
        $response->seeJson($expectedJsonError);
    }

    public function missingUserDataProvider()
    {
        return [
            'User without name' => [
                'Data' => [
                    'age' => 20,
                    'email' => 'foo.bar@gmail.com'
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'name' => [
                            'The name field is required.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
            'User without age' => [
                'Data' => [
                    'name' => 'Foo Bar',
                    'email' => 'foo.bar@gmail.com'
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'age' => [
                            'The age field is required.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
            'User without email' => [
                'Data' => [
                    'name' => 'Foo Bar',
                    'age' => 20,
                ],
                'Expected json error' => [
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'email' => [
                            'The email field is required.'
                        ]
                    ],
                    'status_code' => 422,
                ],
            ],
        ];
    }

    /**
     * @dataProvider invalidUserDataProvider
     */
    public function testPostUserShouldReturnErrorsWhenInvalidDataIsPassed(
        $data,
        $expectedJsonError
    ) {
        $response = $this->json(
            'POST',
            '/users',
            $data,
            $this->getHeaders()
        );

        $response->seeStatusCode(422);
        $response->seeJson($expectedJsonError);
    }

    public function invalidUserDataProvider()
    {
        return [
            'Invalid user name type' => [
                'Data' => [
                    'name' => 1,
                    'age' => 20,
                    'email' => 'foo.bar@gmail.com'
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
                    'name' => 'Foo Bar',
                    'age' => 'a',
                    'email' => 'foo.bar@gmail.com'
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
                    'name' => 'Foo Bar',
                    'age' => 100,
                    'email' => 'foo.bar@gmail.com'
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
                    'name' => 'Foo Bar',
                    'age' => -1,
                    'email' => 'foo.bar@gmail.com'
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
                    'name' => 'Foo Bar',
                    'age' => 1,
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

    public function testPostUserShouldReturnEmailAlreadyTakenWhenDuplicatedEmailIsPassed()
    {
        $user = new User();
        $user->name = 'Foo Bar';
        $user->age = 20;
        $user->email = 'foo.bar@gmail.com';

        $user->save();

        $response = $this->json(
            'POST',
            '/users',
            [
                'name' => 'Foo Bar',
                'age' => 20,
                'email' => 'foo.bar@gmail.com'
            ],
            $this->getHeaders()
        );

        $response->seeStatusCode(422);
        $response->seeJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email has already been taken.'
                ]
            ],
            'status_code' => 422,
        ]);
    }
}
