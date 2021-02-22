<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone_number', 'password', 'status', 'is_phone_verified', 'cover'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function exchanges() {
        return $this->hasMany(Exchange::class);
    }
    public function rents() {
        return $this->hasMany(Rent::class);
    }
    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
    public function lends() {
        return $this->hasMany(Lender::class, 'lender_id', 'id');
    }

    public function lendPosts() {
        return $this->hasMany(Lender::class, 'renter_id', 'id');
    }

    public function transactionHistory() {
        return $this->hasMany(TransactionHistory::class, 'user_id', 'id');
    }
}
