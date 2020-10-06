<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'expiring_date', 'what_time_mail_hour', 'what_time_mail_minute', 'how_days_mail',
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

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function visitDatas()
    {
        return $this->hasMany('App\VisitData');
    }

    public function plans()
    {
        return $this->hasMany('App\Plan');
    }

    public static function boot()
    {
        parent::boot();
    }

}
