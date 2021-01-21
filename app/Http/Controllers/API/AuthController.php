<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UpdateUserByPhoneRequest;
use App\Http\Requests\UserCreateByEmailRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Jobs\SendResetPasswordLinkToEmail;
use App\Mail\SendPasswordResetMail;
use App\Models\ResetPasswordToken;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserLoginService;
use App\Services\UserLogoutService;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Str;


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
        $user['identification_image'] = $user->identification_image ? asset($user->identification_image) : '';
        $user['image'] = $user->image ? asset($user->image) : '';
        return response()->json(['error' => false, 'data' => $user]);
    }

    /**
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function updateUserByPhone(Request $request)
    {
        $count = isset($request->phone_number) ? User::where('phone_number', $request->phone_number)->where('id', '!=', auth()->user()->id)->count() : 0;
        $countEmail = isset($request->email) ? User::where('email', $request->email)->where('id', '!=', auth()->user()->id)->count() : 0;
        
        if ($count > 0 || $countEmail > 0) {
            return response()->json([
                'error' => true, 
                'data' => [
                    'isPhoneExists' => $count > 0 ? true : false,
                    'isEmailExists' => $countEmail > 0 ? true : false
                ]
            ]); 
        }

        $user = $this->userRepository->update($request);
        $user['identification_image'] = $user->identification_image ? asset($user->identification_image) : '';
        $user['image'] = $user->image ? asset($user->image) : '';
        return response()->json(['error' => false, 'data' => $user]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function emailRegistration(Request $request)
    {
        $data = $this->userRepository->emailRegistration($request);
        if ($data['error'] == true) {
            return response()->json($data);
        }
        $data['token'] = $this->generateAccessToken($data['user']);
        $data['image'] = $data['user']['image'] ? asset($data['user']['image']) : '';

        return response()->json($data);
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
            $token = hash('sha256', Str::random(30));
            $link = env('GAMEHUB_FRONT') . '/update-password/' . $token;
            $expires = Carbon::now()->addHours(1)->format('Y-m-d H:i:s');
            $create = ResetPasswordToken::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => $expires
            ]);

            Mail::to($user->email)
                ->queue(new SendPasswordResetMail($user->name, $link));
            $user->image = $user->image ? asset($user->image) : '';

            return $this->response->array([
                'error' => false,
                'message' => 'Password not set',
                'user' => $user,
                'isPaswordEmpty' => true
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'Password is set',
            'isPaswordEmpty' => false
        ]);
    }

    public function checkEmailExist(Request $request)
    {
        $user = $this->userRepository->checkEmailExist($request);
        if ($user) {
            return $this->response->array([
                'error' => false,
                'message' => 'Email exist',
                'user' => $user
            ]);
        }
        return $this->response->array([
            'error' => true,
            'message' => 'Email not exist'
        ]);
    }

}
