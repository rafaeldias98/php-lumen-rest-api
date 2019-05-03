<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function loadAll()
    {
        return User::paginate(10);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function save(User $user)
    {
        $user->save();
        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
