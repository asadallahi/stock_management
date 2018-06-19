<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model {
    protected $table = 'entities';
    use SoftDeletes;
    protected $fillable = [
        'license_id',
        'user_id',
        'name',
        'preview',
        'deep_link',
        'created_by',
        'expire_time',
    ];
}
