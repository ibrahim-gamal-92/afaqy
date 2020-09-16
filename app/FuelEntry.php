<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelEntry extends Model
{
    protected $fillable = [
        'vehicle_id', 'entry_date', 'volume', 'cost'
    ];
}
