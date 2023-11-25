<?php

namespace App\Repositories\Crud;

interface CrudRepositoryInterface
{
    public function create(array $payload);
    public function read($request);
    public function readById($id);
    public function update(array $payload, $id);
    public function delete($id);
}
