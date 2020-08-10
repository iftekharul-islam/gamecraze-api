<?php


namespace App\Repositories\Admin;


use App\Models\User;

class UserRepository
{

    public function user(){
        return User::with('roles')->whereHas('roles', function ($query) {
            return $query->where('name','!=', 'admin');
        })->get();
    }

     public function findById($id){
            return User::with('roles', 'address')->findOrFail($id);
        }

}
