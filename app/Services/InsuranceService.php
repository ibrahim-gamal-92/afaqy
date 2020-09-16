<?php

namespace App\Services;

class InsuranceService extends ExpenseService
{
    public function __construct()
    {
        $this->table = 'insurance_payments';
        $this->type = 'insurance';
        $this->costAttr = 'amount';
        $this->createdAtAttr = 'contract_date';
    }



}