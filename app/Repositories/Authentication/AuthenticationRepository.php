<?php

namespace App\Repositories\Authentication;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;
use DB, JWTAuth, Hash;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function login(array $credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            return [
                'code' => JsonResponse::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized'
            ];
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function me()
    {
        return [
            'code' => JsonResponse::HTTP_OK,
            'message' => 'Get profile successfully!',
            'contents' => auth()->user(),
        ];
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function logout()
    {
        auth()->logout();
        return [
            'code' => JsonResponse::HTTP_OK,
            'message' => 'Successfully logged out'
        ];
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     * @author Rangga Darmajati
     */
    protected function respondWithToken($token)
    {
        return [
            'code' => JsonResponse::HTTP_OK,
            'message' => 'Generate token successfully!',
            'contents' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ],
        ];
    }

    /**
     * Get the raw JWT payload
     * @author Rangga Darmajati
     */
    public function jwtPayload()
    {
        $payload = auth()->payload();
        return $payload->toArray();
    }
}
