<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoHeaders()
    {
        $response = $this->get('/api/v1/expenses');
        $response->assertStatus(302);
    }

    public function testNoName()
    {
        $response = $this->json('GET', '/api/v1/expenses');
        $response->assertStatus(422);
    }

    public function testName()
    {
        $response = $this->json('GET', '/api/v1/expenses' , ['name' => 'test']);
        $response->assertStatus(200);
    }

    public function testInvalidTypes()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'types' => 'fuel,oil1',
        ]);
        $response->assertStatus(422);
    }

    public function testTypes()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'types' => 'fuel,insurance',
        ]);
        $response->assertStatus(200);
    }

    public function testInvalidMinCost()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'minCost' => 'test',
        ]);
        $response->assertStatus(422);
    }

    public function testMinCost()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'minCost' => '2',
        ]);
        $response->assertStatus(200);
    }

    public function testInvalidMinDate()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'minDate' => 'test',
        ]);
        $response->assertStatus(422);
    }

    public function testMinDate()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'minDate' => '2020-01-01',
        ]);
        $response->assertStatus(200);
    }

    public function testInvalidSortAttribute()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'sort' => 'id',
        ]);
        $response->assertStatus(422);
    }

    public function testSortAttribute()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'sort' => 'cost',
        ]);
        $response->assertStatus(200);
    }

    public function testInvalidSortDirection()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'direction' => 'as',
        ]);
        $response->assertStatus(422);
    }

    public function testSortDirection()
    {
        $response = $this->json('GET', '/api/v1/expenses' , [
            'name' => 'test',
            'direction' => 'asc',
        ]);
        $response->assertStatus(200);
    }
}
