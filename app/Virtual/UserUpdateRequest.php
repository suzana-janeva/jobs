<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Update User Request",
 *      description="Update User request body data",
 *      type="object"
 * )
 */

class UserUpdateRequest
{
   /**
     * @OA\Property(
     *      title="First name",
     *      description="User's first name",
     *      example="John"
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *      title="Last Name",
     *      description="User's last name",
     *      example="Doe"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="User's email address",
     *      example="john@doe.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password must be at least 8 characters long and contain a mix of letters and numbers.",
     *      example="passwordCreate12",
     * )
     *
     * @var string
     */
    public $password;

     /**
     * @OA\Property(
     *      title="Password confirmation",
     *      description="Password confirmation",
     *      example="passwordCreate12",
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
