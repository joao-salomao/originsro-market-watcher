<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AlertMatch extends Model
{
    protected $fillable = [
        'alert_id', 'shop_name', 'owner_name', 'map', 'location_x', 'location_y'
    ];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
}
