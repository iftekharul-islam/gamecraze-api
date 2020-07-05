<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Services\UserLoginService;
use App\Services\UserLogoutService;
use Illuminate\Http\Request;



class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserLoginService
     */
    private $loginService;
    /**
     * @var UserLogoutService
     */
    private $logoutService;

    /**
     * AuthController constructor.
     * @param UserRepository $userRepository
     * @param UserLoginService $loginService
     * @param UserLogoutService $logoutService
     */
    public function __construct(UserRepository $userRepository, UserLoginService $loginService, UserLogoutService $logoutService)
    {
        $this->userRepository = $userRepository;
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
    }

    /**
     * @param $user
     * @return mixed
     */
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserCreateRequest $request)
    {
        $user = $this->userRepository->create($request);

        return response()->json($user);
    }

    /**
     * @param UserLoginRequest $request
     * @return int
     */
    public function login(UserLoginRequest $request)
    {
        return $this->loginService->login($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->logoutService->logout();
        return response()->json("Logged out successfully", 200);
    }

    /**
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request)
    {
        $user = $this->userRepository->update($request);
        return response()->json($user);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return response()->json("User Deleted successfully");
    }

}
