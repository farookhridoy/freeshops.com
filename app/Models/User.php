<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'bio',
        'phone',
        'website',
        'location',
        'location_lat',
        'location_long',
        'fcm_token',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function store() {
        return $this->hasOne('App\Models\Store');
    }

    public function listings() {
        return $this->hasMany('App\Models\Listing');
    }

    public function favourites() {
        return $this->hasMany('App\Models\Favourite');
    }

    public function cart() {
        return $this->hasMany('App\Models\Cart');
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction');
    }

    public function participants() {
        return $this->hasMany('App\Models\Participant');
    }
}
