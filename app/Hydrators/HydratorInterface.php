<?php

namespace App\Hydrators;

interface HydratorInterface
{
    public function hydrate(Array $data, $object);
}
