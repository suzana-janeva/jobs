<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Create Gig Request",
 *      description="Create Gig request body data",
 *      type="object",
 *      required={"name","timestamp_start", "timestamp_end","number_of_positions","pay_per_hour"}
 * )
 */

class GigRequest
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
     *      description="Gig's name",
     *      example="Gig name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the Gig",
     *      example="Doe"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Timestamp start",
     *      description="Gig's timestamp start",
     *      format="date-time",
     *      example="10/25/2024 12:00 AM"
     * )
     *
     * @var string
     */
    public $timestamp_start;

     /**
     * @OA\Property(
     *      title="Timestamp end",
     *      description="Gig's timestamp end",
     *      format="date-time",
     *      example="10/27/2024 12:00 PM"
     * )
     *
     * @var string
     */
    public $timestamp_end;
    
     /**
     * @OA\Property(
     *      title="Number of positions",
     *      description="Gig's number of positions",
     *      example="10"
     * )
     *
     * @var int
     */
    public $number_of_positions;

     /**
     * @OA\Property(
     *      title="Pay per hour",
     *      description="Gig's pay per hour",
     *      format="double",
     *      example=35.5
     * )
     *
     * @var number
     */
    public $pay_per_hour;

    /**
     * @OA\Property(
     *      title="Status",
     *      description="Gig's status",
     *      example=0
     * )
     *
     * @var boolean
     */
    public $status;
}