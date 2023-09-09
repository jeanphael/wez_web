<?php
namespace App\Entities;
 class Ticket 
 {
     protected $primaryKey = 'idEvent';
   
    protected $idPointOfSale;
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