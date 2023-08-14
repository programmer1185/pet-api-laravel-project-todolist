<?php

namespace App\DTO;

class RegisterDto
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

     /**
     * @var string
     */
    public $password;

    public function __construct(string $name, string $email, string $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
