<?php

namespace App\Http\Swagger;

/**
 * @OA\Schema(
 *      title="General Root Request",
 *      description="General schema for Root request body data",
 *      type="object"
 * )
 */

class GeneralRootRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of node",
     *      example="Bambang"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Gender",
     *      description="Gender of node",
     *      example="1"
     * )
     *
     * @var boolean
     */
    public $gender;
}
