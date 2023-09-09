<?php namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
  protected $table = 'event';
  protected $returnType = 'array';
  protected $allowedFields = ['idUser', 'idEvent'
  , 'idOrganizer','idPlace','idPrice'];

  public function getAll()
   {
	  	return $this->findAll();
	}

	public function agendaListByIdUser($idUser)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('agenda');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,price.classic,price.silver,price.premium');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('price', 'event.idPrice = price.idPrice');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$query = $builder->get()->getResult();
		return $query;
				 
	}
 	public function agendaSave($agenda)
   {
	  	return $this->save($agenda);
	}

	
}