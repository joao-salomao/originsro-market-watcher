<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'item_id',
        'max_price'
    ];

    public function matches()
    {
        return $this->hasMany(AlertMatch::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
