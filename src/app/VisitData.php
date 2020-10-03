<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitData extends Model
{
    use SoftDeletes;
    
    protected $table = 'visit_datas';

    protected $fillable = [
        'user_id', 'customer_id', 'date', 'pay', 'person', 'comment',
    ];
}
