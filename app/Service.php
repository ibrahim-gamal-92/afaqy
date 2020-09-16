<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'vehicle_id', 'start_date', 'end_date', 'invoice_number', 'purchase_order_number', 'status', 'discount', 'tax',
        'total'
    ];
}
