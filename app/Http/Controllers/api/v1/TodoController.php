<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Crud\CrudRepository;
use App\Repositories\Authentication\AuthenticationRepository;
use App\Models\Todo;
use App\Http\Requests\api\v1\CreateTodoRequest;

class TodoController extends Controller
{
    // space that we can use the repository from
    protected $crudRepository;
    protected $authenticationRepository;
    public function __construct(Todo $todo)
    {
        // set the model on repository
        $this->crudRepository = new CrudRepository($todo);
        $this->authenticationRepository = new AuthenticationRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = $this->crudRepository->read($request);
        return response()->success($res, $res['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTodoRequest $request)
    {
        $auth = $this->authenticationRepository->me();
        $userId = $auth['contents']['id'];
        $payload = [
            'user_id' => $userId,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];
        $res = $this->crudRepository->create($payload);
        return response()->success($res, $res['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = $this->crudRepository->readById($id);
        return response()->success($res, $res['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payload = $request->all();
        $res = $this->crudRepository->update($payload, $id);
        return response()->success($res, $res['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->crudRepository->delete($id);
        return response()->success($res, $res['code']);
    }
}
