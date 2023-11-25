<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DB;

class TodoTest extends TestCase
{
    /**
     * feature create todo
     *
     * @return void
     * @author rangga darmajati
     */
    public function testCreateTodo()
    {
        $token = 'bearer '.auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => $token,
        ])->post('/api/v1/todo', [
            'name' => 'Todo Feature Test',
            'description' => 'Todo Feature Test Description'
        ]);
        $response->assertStatus(201);
    }

    /**
     * feature get all todo data
     *
     * @return void
     * @author rangga darmajati
     */
    public function testListTodo()
    {
        $token = 'bearer '.auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => $token,
        ])->get('/api/v1/todo');

        $response->assertStatus(200);
    }

    /**
     * feature detail todo data
     *
     * @return void
     * @author rangga darmajati
     */
    public function testDetailTodo()
    {
        $id = DB::table('todos')->select('id')->orderBy('created_at', 'desc')->limit(1)->first()->id;
        $token = 'bearer '.auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => $token,
        ])->get('/api/v1/todo/'.$id);
        $response->assertStatus(200);
    }

    /**
     * feature update todo data
     *
     * @return void
     * @author rangga darmajati
     */
    public function testUpdateTodo()
    {
        $id = DB::table('todos')->select('id')->orderBy('created_at', 'desc')->limit(1)->first()->id;
        $token = 'bearer '.auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => $token,
        ])->put('/api/v1/todo/'.$id, [ 'status' => 1 ]);
        $response->assertStatus(200);
    }

    /**
     * feature delete todo data
     *
     * @return void
     * @author rangga darmajati
     */
    public function testDeleteTodo()
    {
        $id = DB::table('todos')->select('id')->orderBy('created_at', 'desc')->limit(1)->first()->id;
        $token = 'bearer '.auth()->tokenById(1);
        $response = $this->withHeaders([
            'Authorization' => $token,
        ])->delete('/api/v1/todo/'.$id);
        $response->assertStatus(200);
    }
}
