<?php
namespace App\Entities;
 class PrintPrice 
 {
    protected $primaryKey = 'id';
     
    protected $id;
    protected $name;
    protected $normal;
    protected $banniere;
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