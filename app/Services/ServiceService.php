<?php

namespace App\Services;

class ServiceService extends ExpenseService
{
    public function __construct()
    {
        $this->table = 'services';
        $this->type = 'service';
        $this->costAttr = 'total';
        $this->createdAtAttr = 'created_at';
    }



}