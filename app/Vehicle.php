<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name', 'plate_number', 'imei', 'vin', 'year', 'license'
    ];

    public function fuelEntries(){
        return $this->hasMany(FuelEntry::class,'vehicle_id', 'id');
    }

    public function insurancePayments(){
        return $this->hasMany(InsurancePayment::class,'vehicle_id', 'id');
    }

    public function services(){
        return $this->hasMany(Service::class,'vehicle_id', 'id');
    }
}
