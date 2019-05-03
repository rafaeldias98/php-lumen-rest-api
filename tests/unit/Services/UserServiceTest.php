<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Services\UserService;
use App\Repositories\UserRepository;
use App\Hydrators\Hydrator;
use App\Exceptions\User\UserNotFoundException;

class UserServiceTest extends TestCase
{
    public function setUp()
    {
        $this->userMock = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->userMock->id = 1;
        $this->userMock->name = 'Foo Bar';
        $this->userMock->age = 20;
        $this->userMock->email = 'foo.bar@gmail.com';

        $this->userRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->setMethods(['findById'])
            ->getMock();

        $this->hydratorMock = $this->getMockBuilder(Hydrator::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetUserShouldReturnExceptionWhenReturnedObjectIsNotInstanceOfUser()
    {
        $this->userRepositoryMock->expects($this->once())
            ->method('findById')
            ->willReturn([]);

        $userService = new UserService(
            $this->userRepositoryMock,
            $this->hydratorMock
        );

        $this->expectException(UserNotFoundException::class);
        $userService->getUser(1);
    }

    public function testGetUserShouldReturnFoundedUserWhenValidIdIsPassed()
    {
        $this->userRepositoryMock->expects($this->once())
            ->method('findById')
            ->willReturn($this->userMock);

        $userService = new UserService(
            $this->userRepositoryMock,
            $this->hydratorMock
        );

        $this->assertEquals(
            $this->userMock,
            $userService->getUser($this->userMock->id)
        );
    }
}
