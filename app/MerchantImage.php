<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantImage extends Model
{
    protected $table = 'merchant_images';
    protected $fillable = [
        'file_name',
    ];
}
