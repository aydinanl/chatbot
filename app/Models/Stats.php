<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Stats extends Model
{

    protected $table = 'stats';
    protected $dateFormat = 'U';
    protected $dates = ['created_at,deleted_at'];

    protected $hidden = [];

    protected $fillable = [
        'id', 'message_c', 'seen_c', 'unsuccess_c'
    ];
}
