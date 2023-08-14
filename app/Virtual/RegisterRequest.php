<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Register request",
 *      description="Register request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class RegisterRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name",
     *      example="John Doe"
     * )
     *
     * @var string
     */
    public $name;

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
     *      description="Password"
     * )
     *
     * @var string
     */
    public $password;
}
