<?php

namespace App\Repositories\Authentication;

interface AuthenticationRepositoryInterface
{
    public function login(array $data);
    public function me();
    public function logout();
    public function refresh();
    public function jwtPayload();
}
