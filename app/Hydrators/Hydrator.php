<?php

namespace App\Hydrators;

class Hydrator implements HydratorInterface
{
    public function hydrate(Array $data, $object)
    {
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }
}
