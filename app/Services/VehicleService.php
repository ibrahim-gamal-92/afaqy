<?php

namespace App\Services;

use App\Rules\MultipleValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VehicleService
{
    protected $query;
    protected $fuel;
    protected $insurance;
    protected $service;
    protected $types;
    protected $sort;

    protected $params;

    public function __construct(FuelService $fuel, InsuranceService $insurance, ServiceService $service)
    {
        $this->query = DB::table('vehicles')->select('vehicles.id as id', 'vehicles.name as vehicleName', 'vehicles.plate_number as plateNumber');
        $this->fuel = $fuel;
        $this->insurance = $insurance;
        $this->service = $service;
        $this->types = ['fuel', 'insurance', 'service'];
        $this->sort = [
            'value' => 'cost',
            'direction' => 'asc'
        ];


    }

    protected function initParams($request){
        $this->params = $request->validate([
            'name' => ['required', 'string'],
            'types' => new MultipleValue(['fuel', 'insurance', 'service']),
            'minCost' => ['numeric'],
            'maxCost' => ['numeric'],
            'minDate' => ['date'],
            'maxDate' => ['date'],
        ]);
    }

    protected function initSort($request){
        $sort = $request->validate([
            'sort' => ['in:cost,createdAt'],
            'direction' => ['in:asc,desc'],
        ]);
        if(isset($sort['sort'])){
            $this->sort['value'] = $sort['sort'];
        }
        if(isset($sort['direction'])){
            $this->sort['direction'] = $sort['direction'];
        }
    }

    protected function setName(){
        $this->query->where('name', 'LIKE', "%{$this->params['name']}%");
    }

    protected function setTypes(){
        if(isset($this->params['types'])){
            $this->types = explode(',', $this->params['types']);
        }
        if(in_array('fuel', $this->types)) {
            $this->fuel->joinData($this->query);
        }
        if(in_array('insurance', $this->types)) {
            $this->insurance->joinData($this->query);
        }
        if(in_array('service', $this->types)) {
            $this->service->joinData($this->query);
        }
    }

    protected function setMinCost(){
        if(isset($this->params['minCost'])){
            foreach ($this->types as $service){
                $this->$service->setMinCost($this->params['minCost']);
            }
        }

    }

    protected function setMaxCost(){
        if(isset($this->params['maxCost'])){
            foreach ($this->types as $service){
                $this->$service->setMaxCost($this->params['maxCost']);
            }
        }
    }

    protected function setMinCreatedDate(){
        if(isset($this->params['minDate'])){
            foreach ($this->types as $service){
                $this->$service->setMinCreatedDate($this->params['minDate']);
            }
        }
    }

    protected function setMaxCreatedDate(){
        if(isset($this->params['maxDate'])){
            foreach ($this->types as $service){
                $this->$service->setMaxCreatedDate($this->params['maxDate']);
            }
        }
    }

    protected function unionData(){
        $first = array_shift($this->types);
        $this->query = clone ($this->$first->getQuery());
        foreach ($this->types as $service){
            $query = $this->$service->getQuery();
            $this->query->unionAll($query);
        }
    }

    protected function sort(){
        $this->query->orderBy($this->sort['value'], $this->sort['direction']);
    }

    protected function execute(){
        $request = request();
        $this->initSort($request);
        $this->initParams($request);
        $this->setName();
        $this->setTypes();
        $this->setMinCost();
        $this->setMaxCost();
        $this->setMinCreatedDate();
        $this->setMaxCreatedDate();
        $this->unionData();
        $this->sort();
    }

    public function getData()
    {
        $this->execute();
//        return $this->query->count();
        return $this->query->get()->toArray();
    }

}