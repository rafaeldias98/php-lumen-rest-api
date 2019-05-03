<?php

namespace App\Services;

use App\Models\User;
use App\Hydrators\Hydrator;
use App\Repositories\UserRepository;
use App\Exceptions\User\UserNotFoundException;

class UserService
{
    private $userRepository;
    private $hydrator;

    public function __construct(
        UserRepository $userRepository,
        Hydrator $hydrator
    ) {
        $this->userRepository = $userRepository;
        $this->hydrator = $hydrator;
    }

    public function listUsers()
    {
        return $this->userRepository->loadAll();
    }

    public function getUser($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user instanceof User) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function createUser($data)
    {
        $user = $this->hydrator->hydrate($data, new User);

        return $this->userRepository->save($user);
    }

    public function deleteUser($id)
    {
        $user = $this->getUser($id);

        return $this->userRepository->delete($user);
    }

    public function updateUser($id, $data)
    {
        $user = $this->getUser($id);
        $updatedUser = $this->hydrator->hydrate($data, $user);

        $this->userRepository->save($updatedUser);
    }
}
