<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'name', 'email', 'tel', 'birth', 'comment',
    ];

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

        // static::deleted(function ($customer) {
        //     $customer->visitDatas()->delete();
        // });

        // static::deleted(function ($customer) {
        //     $customer->plans()->delete();
        // });
    }
}
