<?php

namespace App\Services;

class FuelService extends ExpenseService
{
    public function __construct()
    {
        $this->table = 'fuel_entries';
        $this->type = 'fuel';
        $this->costAttr = 'cost';
        $this->createdAtAttr = 'entry_date';
    }



}