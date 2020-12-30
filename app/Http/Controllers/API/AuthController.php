<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Services\UserLoginService;
use App\Services\UserLogoutService;
use App\Transformers\UserTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\JsonResponse;
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
     * @return \Dingo\Api\Http\Response
     */
    public function register(UserCreateRequest $request)
    {
        $user = $this->userRepository->create($request);

        if ($user == false) {
            throw new StoreResourceFailedException();
        }
        return $this->response->item((object)$user, new UserTransformer());
    }

    /**
     * @param UserLoginRequest $request
     * @return int
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->loginService->login($request);
        logger($token);
        if ($token == false) {
            return $this->response->array([
                'error' => true,
                'message' => 'Wrong email or password'
            ]);
        }
//        if ($token['message'] == 'inactiveUser') {
//            return $this->response->array([
//                'error' => true,
//                'message' => 'inactiveUser'
//            ]);
//        }

        $token['error'] = false;
        return $this->response->array($token);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $this->logoutService->logout();
        return response()->json("Logged out successfully", 200);
    }

    /**
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request)
    {
        $user = $this->userRepository->update($request);
        return response()->json($user);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return response()->json("User Deleted successfully");
    }

    public function checkPassword(Request $request)
    {
        $user = $this->userRepository->checkPassword($request);
        if ($user) {
            return $this->response->array([
                'error' => false,
                'message' => 'Password not set'
            ]);
        }
        return $this->response->array([
            'error' => true,
            'message' => 'Password is set'
        ]);
    }

}
