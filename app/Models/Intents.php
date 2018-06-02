<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


/**
 * @property int $_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */

class Intents extends Model
{
    use SoftDeletes;

    protected $table = 'intents';
    protected $dateFormat = 'U';
    protected $dates = ['created_at,deleted_at'];

    protected $hidden = [];

    //Define words: cümleyi köklere ayrıştırarak dizi halinde tutulacak.
    //type => 1: default, 2: welcome, 3: active, 4:ending
    protected $fillable = [
        'id', 'name', 'type','define_words', 'output', 'forward', 'forwardID',
        'has_variable', 'variable_names', 'variable_questions', 'variable_values',
        'has_operation', 'operation_type', 'operation_url'
    ];
}
