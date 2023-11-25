<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Authentication\AuthenticationRepository;
use App\Http\Requests\api\v1\LoginRequest;

class AuthController extends Controller
{
    // space that we can use the repository from
    protected $authenticationRepository;
    public function __construct(User $user)
    {
        // set the model on repository
        $this->authenticationRepository = new AuthenticationRepository($user);
    }

    /**
     * Store a Credentials for Login (get Token Access).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati
     */
    public function store(LoginRequest $request)
    {
        $res = $this->authenticationRepository->login($request->all());
        return response()->success($res, $res['code']);
    }

    /**
     * Show authenticated user
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati
     */
    public function me()
    {
        $res = $this->authenticationRepository->me();
        return response()->success($res, 200);
    }

    /**
     * Refresh a new token
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati
     */
    public function refreshToken()
    {
        $res = $this->authenticationRepository->refresh();
        return response()->success($res, 200);
    }

    /**
     * Logout
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati
     */
    public function logout()
    {
        $res = $this->authenticationRepository->logout();
        return response()->success($res, 200);
    }
}
