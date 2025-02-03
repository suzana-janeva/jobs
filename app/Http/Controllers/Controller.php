<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *    title="Freelance jobs API",
 *    version="1.0.0",
 *    description="API documentation for Freelance jobs API."
 * ),
 * 
 *  * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 */
abstract class Controller
{
    use AuthorizesRequests;
}
