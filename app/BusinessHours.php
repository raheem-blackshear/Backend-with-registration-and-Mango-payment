<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    protected $table = 'business_hours';
    protected $fillable = [
        'id_contract',
        'giorno',
        'open_time',
        'close_time',
    ];
}
