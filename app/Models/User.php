<?php

namespace App\Models;

use App\UserVendor;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone_number', 'password', 'rent_limit', 'status', 'is_phone_verified',
        'identification_number', 'identification_image', 'is_verified', 'cover', 'referral_code', 'referred_by',
        'wallet', 'achieve_discount', 'locale'
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
    /**
     * Override parent boot and Call deleting event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($users) {
            foreach ($users->rents()->get() as $rent) {
                $rent->delete();
            }

            foreach ($users->lends()->get() as $lend) {
                $lend->delete();
            }

            foreach ($users->lenderRating()->get() as $rating) {
                $rating->delete();
            }

            foreach ($users->RenterRating()->get() as $rating) {
                $rating->delete();
            }

            foreach ($users->transactionHistory()->get() as $transaction) {
                $transaction->delete();
            }

            foreach ($users->orders()->get() as $order) {
                $order->delete();
            }
        });
    }
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

    public function walletHistory() {
        return $this->hasMany(WalletHistory::class, 'user_id', 'id');
    }

    public function lenderRating()
    {
        return $this->hasMany(Rating::class, 'lender_id', 'id');
    }

    public function RenterRating()
    {
        return $this->hasMany(Rating::class, 'renter_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(GameOrder::class, 'user_id', 'id');
    }
    public function vendor()
    {
        return $this->hasOne(UserVendor::class, 'user_id', 'id');
    }
}
