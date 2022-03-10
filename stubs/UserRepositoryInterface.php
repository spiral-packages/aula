<?php

namespace Spiral\Aula\Stubs;

interface UserRepositoryInterface
{
    public function findOne($value): AuthenticableInterface;
}
