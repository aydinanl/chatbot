<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    protected $table = 'feedback';
    protected $dateFormat = 'U';
    protected $dates = ['created_at,deleted_at'];

    protected $hidden = [];

    protected $fillable = [
        'id', 'name', 'feedback', 'success'
    ];
}
