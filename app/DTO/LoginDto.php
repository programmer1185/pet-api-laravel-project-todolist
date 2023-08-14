<?php

namespace App\DTO;

class LoginDto
{
    /**
     * @var string
     */
    public $email;

     /**
     * @var string
     */
    public $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
