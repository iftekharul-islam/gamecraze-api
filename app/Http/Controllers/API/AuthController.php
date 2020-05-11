<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Repositories\UserRepository;
use App\Services\UserLoginService;
use App\Services\UserLogoutService;
use App\Notifications\RequestEmail;
use App\User;
use Illuminate\Http\Request;



class AuthController extends BaseController
{
    private $userRepository;
    private $loginService;
    private $logoutService;

    public function __construct(UserRepository $userRepository, UserLoginService $loginService, UserLogoutService $logoutService)
    {
        $this->userRepository = $userRepository;
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
    }

    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }


    public function register(UserCreateRequest $request)
    {
        $user = $this->userRepository->create($request);

        return response()->json($user);
    }

    public function login(UserLoginRequest $request)
    {
        $token = $this->loginService->login($request);

        return response()->json([
            'token' => $token->accessToken
        ]);
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = Auth::user();

            $token = $user->createToken($user->email.'-'.now());
            $user->notify(new RequestEmail());
            return response()->json([
                'token' => $token->accessToken
            ]);
        }
    }

    public function logout(Request $request)
    {
        $this->logoutService->logout();
        return response()->json("Logged out successfully", 200);
    }

    public function edit(Request $request, $userId)
    {
        $this->userRepository->update($request, $userId);
        return response()->json('User successfuly edited');
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return response()->json("User Deleted successfully");
    }

}
