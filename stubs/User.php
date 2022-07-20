<?php

declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation as Cycle;
use App\Repository\UserRepository;

#[Cycle\Entity(repository: UserRepository::class, table: 'users')]
#[Cycle\Table\Index(columns: ['email'], unique: true)]
class User
{
    #[Cycle\Column(type: 'bigPrimary')]
    public int $id;

    #[Cycle\Column(type: 'string')]
    public string $email;

    #[Cycle\Column(type: 'string', name: 'password')]
    public string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }
}
