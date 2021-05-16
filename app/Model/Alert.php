<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'item_id',
        'max_price'
    ];
}
