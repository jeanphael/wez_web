<?php
namespace App\Entities;
 class Picture 
 {
    protected $primaryKey = 'id';
     
    protected $name;
    protected $url;
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
