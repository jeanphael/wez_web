<?php
namespace App\Entities;
 class PointOfSale 
 {
    protected $primaryKey = 'idPointOfSale';
     
    protected $idPointOfSale;
    protected $name;
    protected $lat;
    protected $lng;
    public function __get($key)
    {
        if (property_exists($this, $key))
        { 
            return $this->$key; 
        }
           
    } 
    public function __set($key, $value) {
        if (property_exists($this, $key)) 
        {
            $this->$key = $value;
        } 
    }
}