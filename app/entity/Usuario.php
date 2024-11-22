<?php

namespace proyecto\app\entity;

class Usuario implements IEntity
{
    private $id;
    private $username;
    private $password;
    private $role;

    public function __construct(string $username = "", string $password = "", string $role = "")
    {
        $this->id = null;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
    public function setUsername($username): Usuario
    {
        $this->username = $username;
        return $this;
    }
    public function setPassword($password): Usuario
    {
        $this->password = $password;
        return $this;
    }
    public function setRole($role): Usuario
    {
        $this->role = $role;
        return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUsername(): ?string
    { 
        return $this->username;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function __toString()
    {
        return $this->getUsername();
    }
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'role' => $this->getRole()
        ];
    }
}