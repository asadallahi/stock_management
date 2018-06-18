<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    protected $fillable=[
        'license_id',
        'user_id',
        'name',
        'preview',
        'deep_link',
        'created_by',
        'expire_time',
    ];
}
