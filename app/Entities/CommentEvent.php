<?php
namespace App\Entities;
 class CommentEvent 
 {
    protected $primaryKey = 'idcommentevent';
     
    protected $idEvent;
    protected $idUser;
	protected $comment;
	protected $datecomment;
	
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