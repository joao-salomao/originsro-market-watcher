<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_id',
        'unique_name',
        'name',
        'type',
        'npc_price',
        'icon'
    ];
}
