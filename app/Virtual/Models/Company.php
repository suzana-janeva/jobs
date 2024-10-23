<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Company",
 *     description="Company model",
 *     @OA\Xml(
 *         name="Company"
 *     )
 * )
 */
class Company
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Company's name",
     *      example="Company name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the company",
     *      example="Doe"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Address",
     *      description="Company's address",
     *      example="Company's address"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      property="user",
     *      type="object",
     *      @OA\Property(
     *          property="id",
     *          type="integer",
     *          example=10
     *      ),
     *      @OA\Property(
     *          property="first_name",
     *          type="string",
     *          example="John"
     *      ),
     *      @OA\Property(
     *          property="last_name",
     *          type="string",
     *          example="John"
     *      ),
     *      @OA\Property(
     *          property="email",
     *          type="string",
     *         example="johndoe@example.com"
     *      ),
     * )
     *
     * @var \App\Virtual\Models\User
     */
    private $user;

    /**
     * @OA\Property(
     *     title="user gigs",
     *     description="user gigs",
     *     type="array",
     *     @OA\Items(
     *        @OA\Property(
     *           property="id",
     *           type="integer",
     *           example=1
     *         ),
     *        @OA\Property(
     *           property="name",
     *           type="string",
     *           example="gig name"
     *       ),
     *        @OA\Property(
     *           property="description",
     *           type="string",
     *           example="gig description"
     *       ),
     *       @OA\Property(
     *           property="timestamp_start",
     *           type="string",
     *           example="09/24/2024 12:00 PM"
     *       ),
     *       @OA\Property(
     *           property="timestamp_end",
     *           type="string",
     *           example="09/25/2024 12:00 PM"
     *       ),
     *       @OA\Property(
     *           property="number_of_positions",
     *           type="integer",
     *           example=45
     *         ),
     *      @OA\Property(
     *           property="pay_per_hour",
     *           type="number",
     *           format="double",
     *           example=4.5
     *         ),
     *      @OA\Property(
     *           property="status",
     *           type="boolean",
     *           example=0
     *         ),
     *       @OA\Property(
     *          property="company",
     *          type="object",
     *          @OA\Property(
     *                property="id",
     *               type="integer",
     *              example=10
     *           ),
     *           @OA\Property(
     *               property="name",
     *               type="string",
     *               example="company_name"
     *           ),
     *         ),
     *      ),
     * )
     *
     * @var \App\Virtual\Models\Gig[]
     */
    private $gigs;
}
