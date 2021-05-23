<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AlertMatch extends Model
{
    protected $fillable = [
        'map',
        'amount',
        'alert_id',
        'shop_name',
        'owner_name',
        'location_x',
        'location_y'
    ];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }
}
