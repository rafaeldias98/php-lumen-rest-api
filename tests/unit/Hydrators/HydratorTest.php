<?php

use PHPUnit\Framework\TestCase;
use App\Hydrators\Hydrator;
use App\Models\User;

class HydratorTest extends TestCase
{
    public function testHydrateShouldReturnHydratedObjectGivenObjectData()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Foo Bar';
        $user->age = 20;
        $user->email = 'foo.bar@gmail.com';

        $hydrator = new Hydrator();

        $userData = [
            'id' => 1,
            'name' => 'Foo Bar',
            'age' => 20,
            'email' => 'foo.bar@gmail.com'
        ];

        $this->assertEquals(
            $user,
            $hydrator->hydrate($userData, new User)
        );
    }
}
