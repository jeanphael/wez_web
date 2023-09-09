<?php
namespace App\Entities;
 class Category 
 {
    protected $primaryKey = 'idCategory';
     
    protected $idCategory;
    protected $name;
    protected $listEvents;
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