<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralDescendantRequest;
use App\Http\Requests\GeneralRootRequest;
use App\Models\GenerationTree;
use App\Services\GenerationTreeService;
use App\Util\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenerationTreeController extends Controller
{

    private $generationTreeService;

    public function __construct(GenerationTreeService $generationTreeService)
    {
        $this->generationTreeService = $generationTreeService;
    }

    public function renderTreePage()
    {
        $data = $this->generationTreeService->getAllNode();
        $outputtedData = $data->getData('content');
        return view('generation-tree', ['outputtedData' => $outputtedData]);
    }

    /**
     * @OA\Post(
     *      path="/tree/root/create",
     *      operationId="PostGenerationTreeRoot",
     *      tags={"GenerationTree"},
     *      summary="Create new generation tree root",
     *      description="Returns created generation tree root",
     *      @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/GeneralRootRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Data Created",
     *          @OA\JsonContent(ref="#/components/schemas/GenerationTreeResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable entity"
     *      )
     *     )
     */
    public function createNewRoot(GeneralRootRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return ResponseFormatter::fail('invalid input', $request->validator->errors(), 422);
        }
        return $this->generationTreeService->createNewRoot($request);
    }

    /**
     * @OA\Put(
     *      path="/tree/root/{id}",
     *      operationId="UpdateGenerationTreeRoot",
     *      tags={"GenerationTree"},
     *      summary="Update existing generation tree root",
     *      description="Returns updated generation tree root",
     *      @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *         @OA\Examples(example="int", value="1", summary="Integer of Id"),
     *     ),
     *      @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/GeneralRootRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Updated",
     *          @OA\JsonContent(ref="#/components/schemas/GenerationTreeResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable entity"
     *      )
     *     )
     */
    public function update($id, GeneralRootRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return ResponseFormatter::fail('invalid input', $request->validator->errors(), 422);
        }
        return $this->generationTreeService->update($id, $request);
    }

    /**
     * @OA\Delete(
     *      path="/tree/{id}",
     *      operationId="DeleteGenerationTreeRoot",
     *      tags={"GenerationTree"},
     *      summary="Delete existing generation tree root",
     *      description="Returns Deleted generation tree root",
     *      @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *         @OA\Examples(example="int", value="1", summary="Integer of Id"),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Deleted",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Data Not Found"
     *      )
     *     )
     */
    public function delete($id)
    {
        return $this->generationTreeService->delete($id);
    }

    /**
     * @OA\Get(
     *      path="/tree",
     *      operationId="GetAllNodeGenerationTreeRoot",
     *      tags={"GenerationTree"},
     *      summary="Get All Node from Parent",
     *      description="Return All Node tree root",
     *      @OA\Response(
     *          response=200,
     *          description="Data Updated",
     *          @OA\JsonContent(ref="#/components/schemas/GenerationFullNodeResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Data Not Found"
     *      )
     *     )
     */
    public function getAllNode()
    {
        return $this->generationTreeService->getAllNode();
    }

    /**
     * @OA\Get(
     *      path="/tree/{id}/descendant",
     *      operationId="GetDescendantTreNode",
     *      tags={"GenerationTree"},
     *      summary="Get Parent Node from Given Child id",
     *      description="Return Parent Node from Given Child id",
     *      @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="int"),
     *         @OA\Examples(example="int", value="1", summary="Integer of Id"),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Data Updated",
     *          @OA\JsonContent(ref="#/components/schemas/GenerationFullNodeResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Data Not Found"
     *      )
     *     )
     */
    public function getDescendant($id)
    {
        return $this->generationTreeService->getDescendant($id);
    }

    /**
     * @OA\Post(
     *      path="/tree/descendant/create",
     *      operationId="PostGenerationDescendantRoot",
     *      tags={"GenerationTree"},
     *      summary="Create new generation tree root",
     *      description="Returns created generation tree root",
     *      @OA\RequestBody(
     *          required=false,
     *          @OA\JsonContent(ref="#/components/schemas/GeneralDescendantRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Data Created",
     *          @OA\JsonContent(ref="#/components/schemas/GenerationTreeResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable entity"
     *      )
     *     )
     */
    public function createDescendant(GeneralDescendantRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return ResponseFormatter::fail('invalid input', $request->validator->errors(), 422);
        }
        return $this->generationTreeService->createDescendant($request);
    }
}
