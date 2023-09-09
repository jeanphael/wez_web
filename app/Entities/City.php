<?php
namespace App\Entities;
 class City 
 {
    protected $primaryKey = 'idCity';
     
    protected $idCity;
    protected $name;
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