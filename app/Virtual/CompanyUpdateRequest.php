<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Update Company Request",
 *      description="Update Company request body data",
 *      type="object"
 * )
 */

class CompanyUpdateRequest
{
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
}
