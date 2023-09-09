<?php
namespace App\Entities;
 class Organizer 
 {
    protected $primaryKey = 'idOrganizer';
     
    protected $idOrganizer;
    protected $name;
    protected $description;
    protected $phone;
    protected $email;
	protected $nbFollow;
    protected $idUser;
    protected $nbEvents;
    protected $nif;
    protected $stat;
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