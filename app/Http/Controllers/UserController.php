<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Models\WalletHistory;
use App\Models\WalletHistorys;
use App\Models\walletSpendHistory;
use App\Repositories\Admin\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->user($request);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $this->userRepository->store($request);

        return redirect()->route('user.all')->with("status", 'User successfully created');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->userRepository->findById($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->edit($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request)
    {
        $user =  User::findOrFail($request->id);
        $data = $request->only(['name', 'email', 'rent_limit', 'phone_number', 'password', 'status', 'is_verified', 'confirmPassword', 'identification_number', 'identification_image']);

        if (isset($data['name'])) {
            $user->name = $data['name'];
        }
        if (isset($data['email'])) {
            $user->email = $data['email'];
        }
        if (isset($data['rent_limit'])) {
            $user->rent_limit = $data['rent_limit'];
        }
        if (isset($data['phone_number'])) {
            $user->phone_number = $data['phone_number'];
        }
        if (isset($data['identification_number'])) {
            $user->identification_number = $data['identification_number'];
        }
        if ($request->hasFile('identification_image')) {
            $nid_image = $request->file('identification_image');
            $image_name = 'id_' . time() . '_' . $user->id . '.' . $nid_image->getClientOriginalExtension();
            $path = "identification/" . $image_name;
            $nid_image->storeAs('identification', $image_name);
            $user['identification_image'] = 'storage/' . $path;
        }
        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        if (isset($data['is_verified'])) {
            $user->is_verified = $data['is_verified'];
        }
        if (isset($data['status'])) {
            $user->status = $data['status'];
        }
        $user->save();

        return redirect()->route('user.all')->with('status', 'User successfully updated!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UserIdVerification($id)
    {
        $user = $this->userRepository->idVerification($id);

        if ($user == true){
            return redirect()->back()->with('status', 'User ID successfully verified');
        }

        return redirect()->back()->with('error', 'User ID successfully verified');
    }

    /**
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $date = Carbon::now()->format('d-m-Y');
        ob_end_clean();
        ob_start();
        return (new CustomersExport())->download('customers-'.  time() . '-' . $date  . '.xls');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function referralHistory(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : null;
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : null;

        if ($startDate != null || $endDate != null) {
            $data = WalletHistory::with('User', 'referredUser')
                ->whereDate('created_at', '>=', $startDate ?? Carbon::today()->subDays(30))
                ->whereDate('created_at', '<=', $endDate ?? Carbon::today())
                ->orderBy('created_at', 'DESC')
                ->paginate(config('gamehub.pagination'));
        } else {
            $data = WalletHistory::with('User', 'referredUser')
                ->orderBy('created_at', 'DESC')
                ->paginate(config('gamehub.pagination'));
        }

        $total_earning = 0;

        foreach ($data as $item) {
            $total_earning += $item->amount;
        }

        return view('admin.referral_history.index', compact('data', 'total_earning'));
    }

    public function walletSpendHistory()
    {
        $data = User::join('wallet_spend_histories', 'users.id', '=', 'wallet_spend_histories.user_id')
                ->selectRaw('SUM(amount) as amount, users.name, users.last_name, users.id')
                ->groupBy('wallet_spend_histories.user_id')
                ->paginate(config('gamehub.pagination'));

        $total_spend = 0;
        foreach ($data as $item) {
            $total_spend += $item->amount;
        }

        return view('admin.wallet_spend_history.index', compact('data', 'total_spend'));
    }

    public function walletSpendById($id)
    {
        $data = walletSpendHistory::with('order')
            ->where('user_id', $id)
            ->paginate(config('gamehub.pagination'));

        return view('admin.wallet_spend_history.show', compact('data'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destory($id)
    {
        $user = $this->userRepository->delete($id);

        if ($user == true){
            return redirect()->back()->with('status', 'User deleted successfully');
        }

        return redirect()->back()->with('error', 'User cannot deleted');
    }
}
