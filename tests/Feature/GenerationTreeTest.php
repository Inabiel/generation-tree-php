<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenerationTreeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGetAllNode()
    {
        $response = $this->get('/api/tree');
        $response->assertStatus(200);
    }

    public function testCreateDescendant()
    {
        $data = [
            'name' => 'evan',
            'gender' => 1,
            'parent_id' => 2,
        ];
        $response = $this->post('/api/tree/descendant/create', $data);
        $response->assertStatus(201);
    }

    public function testCreateRootNode()
    {
        $data = [
            'name' => 'evan',
            'gender' => 1,
        ];
        $response = $this->post('/api/tree/root/create', $data);
        $response->assertStatus(201);
    }
    public function testUpdateNode()
    {
        $id = 4;
        $data = [
            'name' => 'evan',
            'gender' => 1,
        ];
        $response = $this->put('/api/tree/' . $id, $data);
        $response->assertStatus(200);
    }
    public function testDeleteNode()
    {
        $id = 5;
        $response = $this->delete('/api/tree/' . $id);
        $response->assertStatus(200);
    }
    public function getDescendant()
    {
        $id = 7;
        $response = $this->get('/api/tree/descendant/' . $id);
        $response->assertStatus(200);
    }
}
