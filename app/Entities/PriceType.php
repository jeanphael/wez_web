<?php
namespace App\Entities;
 class PriceType 
 {
    protected $primaryKey = 'idPriceType';
     
    protected $idPriceType;
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