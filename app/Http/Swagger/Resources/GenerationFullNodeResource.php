<?php

namespace App\Http\Swagger\Resources;

/**
 * @OA\Schema(
 *     title="Generation Tree Resources",
 *     description="Generation Tree resource",
 *     @OA\Xml(
 *         name="GenerationTreeResource"
 *     )
 * )
 */
class GenerationFullNodeResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Http\Swagger\Models\GenerationFullTreeNode[]
     */
    private $data;
}
