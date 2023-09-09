<?php
namespace App\Entities;
 class Follow 
 {
    protected $primaryKey = 'idFollow';
     
    protected $idFollow;
    protected $idUser;
    protected $idOrganizer;
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