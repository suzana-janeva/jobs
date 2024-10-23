<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
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
     *      title="First Name",
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
     *      title="Posted Rate",
     *      description="User's posted rate",
     *      format="double",
     *      example=4.5
     * )
     *
     * @var number
     */
    public $posted_rate;

     /**
     * @OA\Property(
     *     title="user companies",
     *     description="user companies",
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
     *           example="company name"
     *       ),
     *        @OA\Property(
     *           property="description",
     *           type="string",
     *           example="company description"
     *       ),
     *       @OA\Property(
     *           property="address",
     *           type="string",
     *           example="company address"
     *       ),
     *       @OA\Property(
     *           property="number_of_posted_gigs",
     *           type="integer",
     *           example=45
     *         ),
     *      @OA\Property(
     *           property="number_of_started_gigs",
     *           type="integer",
     *           example=4
     *         ),
     *       @OA\Property(
     *          property="user",
     *           type="object",
     *          @OA\Property(
     *               property="id",
     *               type="integer",
     *              example=10
     *           ),
     *           @OA\Property(
     *               property="first_name",
     *               type="string",
     *               example="John"
     *           ),
     *          @OA\Property(
     *               property="last_name",
     *               type="string",
     *               example="John"
     *           ),
     *           @OA\Property(
     *               property="email",
     *               type="string",
     *               example="johndoe@example.com"
     *           ),
     *         ),
     *      ),
     * )
     *
     * @var \App\Virtual\Models\Company[]
     */
    private $companies;

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
     *           type="object",
     *          @OA\Property(
     *               property="id",
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