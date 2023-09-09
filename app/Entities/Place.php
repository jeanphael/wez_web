<?php
namespace App\Entities;
 class Place 
 {
    protected $primaryKey = 'idPlace';
     
    protected $idPlace;
    protected $name;
    protected $lat;
    protected $lng;
    protected $idCity;
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