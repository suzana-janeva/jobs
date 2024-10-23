<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *    title="Gigs API",
 *    version="1.0.0",
 *    description="API documentation for Gigs API."
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
