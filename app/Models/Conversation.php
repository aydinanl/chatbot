<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;

    protected $table = 'conversation';
    protected $dateFormat = 'U';
    protected $dates = ['created_at,deleted_at'];

    protected $hidden = [];

    protected $fillable = [
        'id', 'ip', 'language'
    ];
}
