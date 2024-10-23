<?php


namespace App\Virtual\Resources;


/**
 * @OA\Schema(
 *     title="GigResource",
 *     description="Gig resource",
 *     @OA\Xml(
 *         name="GigResource"
 *     )
 * )
 */
class GigResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Gig
     */
    private $data;
}