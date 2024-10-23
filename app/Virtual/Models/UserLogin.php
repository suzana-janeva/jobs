<?php


namespace App\Virtual\Models;


/**
 * @OA\Schema(
 *     title="User Login",
 *     description="The user login return by the response",
 *     @OA\Xml(
 *         name="UserLogin"
 *     )
 * )
 */
class UserLogin
{
    /**
     * @OA\Property(
     *     title="Token type",
     *     description="This will always be 'Bearer'",
     *     example="Bearer"
     * )
     *
     * @var string
     */
    private $token_type;

    /**
     * @OA\Property(
     *      title="Expires In",
     *      description="Expiration time of the token expressed in seconds counting from the moment of receiving it.",
     *      format="int64",
     *      example=7200
     * )
     *
     * @var integer
     */
    private $expires_in;

    /**
     * @OA\Property(
     *      title="Access Token",
     *      description="The Access Token (JWT). Valid for 8h.",
     *      example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"
     * )
     *
     * @var string
     */
    private $access_token;

    /**
     * @OA\Property(
     *      title="Refresh Access Token",
     *      description="The standard Refresh Token. Valid for 24h.",
     *      example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c"
     * )
     *
     * @var string
     */
    private $refresh_token;
}