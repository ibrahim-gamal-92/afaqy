<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurancePayment extends Model
{
    protected $fillable = [
        'vehicle_id', 'contract_date', 'expiration_date', 'amount'
    ];
}
