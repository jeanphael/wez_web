<?php
namespace App\Entities;
 class User 
 {
     
    protected $idUser;
    protected $name;
    protected $firstname;
    protected $phone;
    protected $email;
    protected $adresse;
    protected $login;
    protected $password;
    protected $image;
    protected $typeUser;
    protected $idOrganizer;
	protected $isActive;

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