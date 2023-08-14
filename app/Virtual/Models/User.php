<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User",
 *     description="Authorization token",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *      title="Token",
     *      description="Authorization token",
     *      example="3|CWCXh9LqmZp3XJSIRqxU0hirKTrhvr2rqjEos5Mw"
     * )
     *
     * @var string
     */
    public $token;
}
