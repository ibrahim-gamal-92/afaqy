<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

abstract class ExpenseService
{

    protected $query;
    protected $type;
    protected $table;
    protected $costAttr;
    protected $createdAtAttr;

    public function joinData($query)
    {
        $this->query = clone($query);
        $this->query
            ->leftJoin("{$this->table}", 'vehicles.id', '=', "{$this->table}.vehicle_id")
            ->addSelect(DB::raw("'{$this->type}' as `type`"))
            ->addSelect(DB::raw("{$this->table}.{$this->costAttr} as `cost`"))
            ->addSelect(DB::raw("Date({$this->table}.{$this->createdAtAttr}) as `createdAt`"))
            ;
    }

    public function setMinCost($cost)
    {
        $this->query->where("{$this->table}.{$this->costAttr}", '>=', $cost);
    }

    public function setMaxCost($cost)
    {
        $this->query->where("{$this->table}.{$this->costAttr}", '<=', $cost);
    }

    public function setMinCreatedDate($date)
    {
        $this->query->where("{$this->table}.{$this->createdAtAttr}", '>=', $date);
    }

    public function setMaxCreatedDate($date)
    {
        $this->query->where("{$this->table}.{$this->createdAtAttr}", '<=', $date);
    }

    public function getQuery(){
        return $this->query;
    }

}