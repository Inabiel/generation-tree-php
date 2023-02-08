<?php

namespace App\Services;

use App\Http\Requests\GeneralDescendantRequest;
use App\Http\Requests\GeneralRootRequest;
use App\Repositories\GenerationTreeRepository;
use App\Util\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use PDO;

class GenerationTreeService
{
    public $generationTreeRepository;

    public function __construct(GenerationTreeRepository $generationTreeRepository)
    {
        $this->generationTreeRepository =  $generationTreeRepository;
    }

    /**
     * Create new root to be filled with descendant.
     *
     * @param  \app\Utilities\Request $request
     * @return \app\Utilities\Response
     */
    public function createNewRoot(GeneralRootRequest $request)
    {
        DB::beginTransaction();
        try {
            $result = $this->generationTreeRepository->createNewRoot($request);
            DB::commit();
            return ResponseFormatter::ok($result, 'new root node created', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::fail('failed to create new root', $th->getMessage(), 422);
        }
    }

    /**
     * get descendant from parent node
     *
     * @param  integer $id
     * @return void
     */
    public function getDescendant($id)
    {
        $result = $this->generationTreeRepository->getParentNode($id);
        if (count($result) < 1) {
            return ResponseFormatter::fail('descendant is empty', 'descendant is empty', 404);
        }
        return ResponseFormatter::ok($result, 'get descendant from root succeed', 200);
    }

    public function getAllNode()
    {
        $result = $this->generationTreeRepository->getAllNode();
        return ResponseFormatter::ok($result, "succeded getting data", 200);
    }

    /**
     * update existing root node
     *
     * @param integer $id
     * @param  \app\Utilities\Request $request
     * @return \app\Utilities\Response
     * @return void
     */
    public function update($id, GeneralRootRequest $request)
    {
        DB::beginTransaction();
        try {
            $result = $this->generationTreeRepository->update($id, $request->all());
            DB::commit();
            return ResponseFormatter::ok($result, 'success updating new root', 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::fail('failed to update existing root', $th->getMessage(), 422);
        }
    }

    /**
     * delete existing node
     *
     * @param  mixed $id
     * @return \app\Utilities\Response
     */
    public function delete($id)
    {
        $deleteResult = $this->generationTreeRepository->delete($id);
        return ResponseFormatter::ok($deleteResult, 'succeded deleting node', 200);
    }

    /**
     * Create new descendant node
     *
     * @param  \app\Utilities\Request $request
     * @return \app\Utilities\Response
     */
    public function createDescendant(GeneralDescendantRequest $request)
    {
        DB::beginTransaction();
        try {
            $result = $this->generationTreeRepository->createDescendant($request);
            DB::commit();
            return ResponseFormatter::ok($result, 'new descendant created', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::fail('failed to create new descendant', $th->getMessage(), 422);
        }
    }
}
