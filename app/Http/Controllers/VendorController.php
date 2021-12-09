<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use App\Models\Vendor;
use App\PhoneNumber;
use App\UserVendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class VendorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory
     * |\Illuminate\View\View
     */
    public function index()
    {
        $vendors = Vendor::orderBy('created_at', 'DESC')->paginate(config('gamehub.pagination'));

        return view('admin.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        return $request->all();

        $data = $request->only(['shop_name', 'trade_license', 'shop_description', 'is_verified', 'status', 'cover_photo', 'profile_photo']);
        $data['is_verified'] = true;
        if ($request->hasFile('cover_photo')) {
            $trending = $request->file('cover_photo');
            $trending_name = $data['shop_name'] . '-trending-' . auth()->user()->id . '-' . time() . '.' . $trending->getClientOriginalExtension();
            $path = "vendor-image/" . $trending_name;
            $trending->storeAs('vendor-image', $trending_name);
            $data['cover_photo'] = 'storage/' . $path;
        }

        if ($request->hasFile('profile_photo')) {
            $cover = $request->file('profile_photo');
            $cover_name = $data['shop_name'] . '-cover-' . auth()->user()->id . '-' . time() . '.' . $cover->getClientOriginalExtension();
            $path = "vendor-image/" . $cover_name;
            $cover->storeAs('vendor-image', $cover_name);
            $data['profile_photo'] = 'storage/' . $path;
        }

        $vendor = Vendor::create($data);

        if(isset($request->phone_number)){
            foreach($request->phone_number as $number){
                PhoneNumber::create([
                    'user_id' =>  $vendor->id,
                    'number' => $number
                ]);
            }
        }

        if(isset($request->addresses)){
           foreach($request->addresses as $key=>$address){
                $addressData []= [
                    'user_id' =>  $vendor->id,
                    'title' => $request->titles[$key],
                    'address' => $address,
                    'state' => $request->states[$key],
                    'city' => $request->cities[$key],
                    'zip_code' => $request->zips[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Address::insert($addressData);
        }

        return redirect()->route('vendor')->with('status', 'Vendor created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor, $id)
    {
        $vendor = Vendor::with('phoneNumbers', 'addresses')->where('id',$id)->first();
//        return $vendor;

        return view('admin.vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor, $id)
    {
        $vendor = Vendor::findOrFail($id);

        return view('admin.vendor.edit',compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor, $id)
    {
//        return $request->all();
        $vendor = $vendor->findOrFail($id);
        $data = $request->only(['shop_name', 'trade_license', 'shop_description', 'status', 'cover_photo', 'profile_photo']);
        if(isset($data['shop_name'])){
            $vendor->shop_name = $data['shop_name'];
        }

        if(isset($data['trade_license'])){
            $vendor->trade_license = $data['trade_license'];
        }

        if(isset($data['shop_description'])){
            $vendor->shop_description = $data['shop_description'];
        }

        if(isset($data['status'])){
            $vendor->status = $data['status'];
        }

        if ($request->hasFile('cover_photo')) {
            $trending = $request->file('cover_photo');
            $trending_name = $data['shop_name'] . '-trending-' . auth()->user()->id . '-' . time() . '.' . $trending->getClientOriginalExtension();
            $path = "vendor-image/" . $trending_name;
            $trending->storeAs('vendor-image', $trending_name);
            $data['cover_photo'] = 'storage/' . $path;
        }

        if ($request->hasFile('profile_photo')) {
            $cover = $request->file('profile_photo');
            $cover_name = $data['shop_name'] . '-cover-' . auth()->user()->id . '-' . time() . '.' . $cover->getClientOriginalExtension();
            $path = "vendor-image/" . $cover_name;
            $cover->storeAs('vendor-image', $cover_name);
            $data['profile_photo'] = 'storage/' . $path;
        }

        $vendor->save();

        if(isset($request->phone_number)){
            foreach($request->phone_number as $number){
                PhoneNumber::create([
                    'user_id' =>  $vendor->id,
                    'number' => $number
                ]);
            }
        }

        if(isset($request->addresses)){
            foreach($request->addresses as $key=>$address){
                $addressData []= [
                    'user_id' =>  $vendor->id,
                    'title' => $request->titles[$key],
                    'address' => $address,
                    'state' => $request->states[$key],
                    'city' => $request->cities[$key],
                    'zip_code' => $request->zips[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            Address::insert($addressData);
        }


        return redirect()->route('vendor')->with('status', 'Vendor updated successfully');
    }

    public function vendorOwner(Request $request)
    {
        if ($request->search) {
            $users = User::where('phone_number', 'LIKE', "%{$request->search}%")
                ->orWhere('email', 'LIKE', "%{$request->search}%")
                ->with('vendor.vendor', 'vendor.role')
                    ->has('vendor')
                    ->paginate(15);
        } else {
            $users = User::with('vendor.vendor', 'vendor.role')
                ->has('vendor')
                ->paginate(15);
        }

//        return $users;
        return view('admin.vendor_user.index', compact('users'));
    }

    public function assignVendorUser()
    {
        $users = User::where('is_verified', 1)
            ->has('vendor', '<', 1)
            ->where('name', '!=', null)->get();
        $otherRoles = ['admin', 'customer'];
        $roles = Role::whereNotIn('name', $otherRoles)
            ->get();
        $vendors = Vendor::where('status', 1)->get();

        return view('admin.vendor_user.show', compact('users', 'roles', 'vendors'));
    }

    public function storeVendorUser(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $vendor = Vendor::findOrFail($request->vendor_id);
        $role = Role::findOrFail($request->role_id);
        $user->assignRole($role);

        UserVendor::create([
           'user_id' =>  $user->id,
           'vendor_id' =>  $vendor->id,
           'role_id' =>  $role->id,
        ]);

        return redirect()->route('vendor.owner')->with('status', 'Vendor assign successfully');


    }

    public function vendorRequest()
    {
        return view('admin.vendor_user.request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
