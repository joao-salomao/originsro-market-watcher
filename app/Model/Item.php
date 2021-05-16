<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable =[
        'unique_name',
        'name',
        'type',
        'npc_price',
        'icon'
    ];
}
