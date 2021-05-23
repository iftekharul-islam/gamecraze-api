<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\BaseController;
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\RoleCreateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return $this->response->collection($users, new UserTransformer());
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function show()
    {
        $user = $this->userRepository->findById();
        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRole(RoleCreateRequest $request)
    {
        $this->userRepository->createRole($request);
        return response()->json(['message' => 'Role Successfully saved!']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRole()
    {
        $roles = $this->userRepository->showRole();
        return response()->json($roles);
    }

    /**
     * @param PermissionCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPermission(PermissionCreateRequest $request)
    {
        $this->userRepository->createPermission($request);
        return response()->json(['message' => 'Permission Successfully saved!']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPermission()
    {
        $permissions = $this->userRepository->showPermission();
        return response()->json($permissions);
    }

    /**
     * @param $role_id
     * @param $per_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function rolehasPermission($role_id, $per_id)
    {
        $this->userRepository->rolehasPermission($role_id, $per_id);
        return response()->json('this role get the permission successfully');
    }

    /**
     * @param $user_id
     * @param $role_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userhasRole($user_id, $role_id)
    {
        $this->userRepository->userhasRole($user_id, $role_id);
        return response()->json('Role has been assigned to the user.');
    }

    /**
     * @param $user_id
     * @param $per_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function userhasPermission($user_id, $per_id)
    {
        $this->userRepository->userhasPermission($user_id, $per_id);
        return response()->json('User get the Permission successfully');
    }

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function profile() {
        $user = auth('api')->user();
        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateCoverImage(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->cover = $request->cover;
            $user->save();

            return $this->response->array([
                'error' => false,
                'message' => 'User cover image updated'
            ]);
        }

        return $this->response->array([
            'error' => true,
            'message' => 'User cover cannot update'
        ]);
    }

    public function applyCode(Request $request)
    {
        if ($request->promo == config('gamehub.promo_code')) {
            return $this->response->array([
                'amount' => config('gamehub.promo_amount'),
                'error' => false
            ]);
        }
        return $this->response->array([
            'amount' => 0,
            'error' => true
        ]);
    }
}
