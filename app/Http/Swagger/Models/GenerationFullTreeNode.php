<?php

namespace App\Http\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Generation Tree",
 *     description="Generation Tree model",
 *     @OA\Xml(
 *         name="Generation Tree"
 *     )
 * )
 */


class GenerationFullTreeNode
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
     *      description="Name Of Generation Tree Node",
     *      example="Budi"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Gender",
     *      description="Name Of Generation Tree Node",
     *      example="1 For Male, 0 for Female"
     * )
     *
     * @var boolean
     */
    public $gender;

    /**
     * @OA\Property(
     *      title="Parent Id",
     *      description="to keep track which is parent and child",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $parent_id;

    /**
     * @OA\Property(
     *      title="Generation Number",
     *      description="to keep track of tree depth",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $generation_number;
}
