<?php

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

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}
