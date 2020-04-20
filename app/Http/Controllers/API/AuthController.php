<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = Auth::user();

            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
                'token' => $token->accessToken
            ]);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json("Logged out successfully", 200);
    }

    public function edit(Request $request,$userId)
    {
        $user = User::find($userId);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json('User successfuly edited');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json("User Deleted successfully");
    }

}
