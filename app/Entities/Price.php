<?php
namespace App\Entities;
 class Price 
 {
    protected $primaryKey = 'idPrice';
     
    protected $idPrice;
    protected $name;
    protected $value;
    protected $idEvent;
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