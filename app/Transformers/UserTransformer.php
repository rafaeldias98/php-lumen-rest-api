<?php

namespace App\Transformers;

use League\Fractal;
use App\Models\User;

class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'age' => $user->age,
            'email' => $user->email,
            'created_at' => date('Y-m-d H:i:s', strtotime($user->created_at)),
            'updated_at' => date('Y-m-d H:i:s', strtotime($user->updated_at)),
        ];
    }
}
