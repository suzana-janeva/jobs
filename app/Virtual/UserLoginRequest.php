<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Login User Request",
 *      description="Login User request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */

class UserLoginRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email Address",
     *      example="john@doe.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password",
     *      example="passwordCreate12",
     * )
     *
     * @var string
     */
    public $password;
}