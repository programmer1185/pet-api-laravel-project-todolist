<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Login request",
 *      description="Login request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class LoginRequest
{
    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email",
     *      example="test@test.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password",
     * )
     *
     * @var string
     */
    public $password;
}
