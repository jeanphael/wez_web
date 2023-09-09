<?php
namespace App\Entities;
 class Event 
 {
    protected $primaryKey = 'idEvent';
     
    protected $idEvent;
    protected $name;
    protected $dateBegin;
    protected $dateEnd;
    protected $description;
    protected $idOrganizer;
    protected $idPlace;
	protected $idCategory;
    protected $image;
	protected $isValidated;
    protected $affichageBan;
    protected $nbJourSupplementaire;
    protected $dureeAffichage;
    protected $dateDebutAffichage;
	protected $dateFinAffichage;
    protected $cout;
    
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