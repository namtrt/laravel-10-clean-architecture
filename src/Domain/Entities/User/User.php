<?php

namespace Src\Domain\Entities\User;

class User
{
    private readonly int $id;
    private string $name;
    private string $email;
    private string $verifiedAt;
    private string $createdAt;

    public function __construct(int $id, string $name, string $email, string $verifiedAt, string $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->verifiedAt = $verifiedAt;
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVerifiedAt(): string
    {
        return $this->verifiedAt;
    }
}
