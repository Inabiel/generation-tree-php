<?php

namespace App\Repositories;

use App\Models\GenerationTree;
use Illuminate\Support\Facades\DB;

class GenerationTreeRepository
{
    public $generationTree;

    /**
     * __construct
     * Constructor for GenerationTree Repository
     * @param  mixed $generationTree
     * @return void
     */
    public function __construct(GenerationTree $generationTree)
    {
        $this->generationTree = $generationTree;
    }

    /**
     * create new Root Tree to be filled with descendant
     *
     * @param  mixed $array
     * @return void
     */
    public function createNewRoot($array)
    {
        $newRootData = new $this->generationTree;
        $newRootData->name = $array->name;
        $newRootData->gender = $array->gender;
        $newRootData->save();
        return $newRootData->fresh();
    }

    /**
     * get all node from the root
     *
     * @return array
     */
    public function getAllNode()
    {
        $query = DB::select(
            "WITH RECURSIVE generation AS (
            SELECT id,
                name,
                parent_id,
              gender,
                0 AS generation_number
            FROM generation_trees
            WHERE parent_id IS NULL
        UNION ALL
            SELECT child.id,
                child.name,
                child.parent_id,
              child.gender,
                generation_number+1 AS generation_number
            FROM generation_trees child
            JOIN generation g
              ON g.id = child.parent_id
        )
        SELECT name,gender,parent_id, generation_number
        FROM generation"
        );
        return $query;
    }

    /**
     * get parent node (upward 1 level) from current node
     *
     * @param  mixed $id
     * @return array
     */
    public function getParentNode($id)
    {
        $query = DB::select(
            "WITH RECURSIVE generation AS (
            SELECT id,
                name,
                parent_id,
              gender,
                0 AS generation_number
            FROM generation_trees
            WHERE parent_id IS NULL
        UNION ALL
            SELECT child.id,
                child.name,
                child.parent_id,
              child.gender,
                generation_number+1 AS generation_number
            FROM generation_trees child
            JOIN generation g
              ON g.id = child.parent_id
        )
        SELECT name,gender,parent_id, generation_number
        FROM generation where parent_id = ?",
            [$id]
        );
        return $query;
    }

    /**
     * Update Single Node
     *
     * @param  integer $id
     * @param  mixed $array
     * @return void
     */
    public function update($id, $array)
    {
        $existingRootData = $this->generationTree->find($id)->update($array);
        return $existingRootData;
    }

    /**
     * delete single node
     *
     * @param  integer $id
     * @param  mixed $array
     * @return void
     */
    public function delete($id)
    {
        $rootToBeDeleted = $this->generationTree->find($id)->delete();
        return $rootToBeDeleted;
    }


    /**
     *
     * Creating a new descendant
     * @param  mixed $array
     * @return mixed
     */
    public function createDescendant($array)
    {
        $descendantData = new $this->generationTree;
        $descendantData->parent_id = $array->parent_id;
        $descendantData->name = $array->name;
        $descendantData->gender =  $array->gender;
        $descendantData->save();
        return $descendantData->fresh();
    }
}
