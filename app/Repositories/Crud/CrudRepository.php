<?php

namespace App\Repositories\Crud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class CrudRepository implements CrudRepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * Save data on db
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function create(array $payload)
    {
        try {
            $this->model->create($payload);
            return [
                'code' => JsonResponse::HTTP_CREATED,
                'message' => 'Create data successfully!',
            ];
        } catch (\Throwable $th) {
            return [
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Create data failed!',
            ];
        }
    }
    
    /**
     * Get All Data
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function read($request)
    {
        $limit = $request->input('limit') ? : 10;
        $data = $this->model->getLists($request)->paginate($limit);
        return [
            'code' => JsonResponse::HTTP_OK,
            'message' => 'Get List of data successfully!',
            'contents' => $data,
        ];
    }

    /**
     * Get Data by id
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function readById($id)
    {
        try {
            $data = $this->model->findOrFail($id);
            return [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Get data successfully!',
                'contents' => $data,
            ];
        } catch (\Throwable $th) {
            return [
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Get data failed!',
            ];
        }
    }

    /**
     * Update Data
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function update(array $payload, $id)
    {
        try {
            $this->model->where('id', $id)->update($payload);
            return [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Update data successfully!',
            ];
        } catch (\Throwable $th) {
            return [
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Update data failed!',
            ];
        }
    }

    /**
     * Delete Data
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function delete($id)
    {
        try {
            $data = $this->model->find($id);
            $data->delete();
            return [
                'code' => JsonResponse::HTTP_OK,
                'message' => 'Delete data successfully!',
                'contents' => $data,
            ];
        } catch (\Throwable $th) {
            return [
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Delete data failed!',
            ];
        }
    }
}
