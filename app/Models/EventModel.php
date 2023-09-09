<?php namespace App\Models;
use CodeIgniter\Model;

class EventModel extends Model
{
  protected $table = 'event';
  protected $primaryKey = 'idEvent';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'dateBegin'
  , 'dateEnd','description','idOrganizer','idPlace','idCategory','cout','image','isValidated','affichageBan','nbJourSupplementaire','dateDebutAffichage','dureeAffichage','dateFinAffichage'];

    public function getAll()
    {
		  return $this->findAll();
	}
	public function searchEvent($textToFind)
	{
		$session = \Config\Services::session(); 
		$db = \Config\Database::connect();
		$builder=$db->table('event');
			$builder->select('event.*,DATE_FORMAT(event.dateBegin, "%d/%m/%Y") as dateDebut,DATE_FORMAT(event.dateEnd,  "%d/%m/%Y") as dateFin,DATE_FORMAT(event.dateBegin, "%H:%i") as heureDebut,DATE_FORMAT(event.dateEnd, "%H:%i") as heureFin,(event.dateDebutAffichage + INTERVAL event.dureeAffichage+event.nbJourSupplementaire DAY) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
			$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
			$builder->join('place', 'event.idPlace = place.idPlace');
			$builder->join('city', 'place.idCity = city.idCity');
			$builder->join('category', 'event.idCategory = category.idCategory');
			if($_SESSION['userType'] != "admin"){
			$builder->where('organizer.idUser',$_SESSION['userId']);
			}
			$builder->where('event.isValidated', 1);
			$builder->Like('event.name', $textToFind);
		//	$builder->orLike('organizer.name', $textToFind);
			/*$builder->orLike('place.name', $textToFind);
			$builder->orLike('event.dateBegin', $textToFind);
			$builder->orLike('event.dateEnd', $textToFind);
			$builder->orLike('event.description', $textToFind);
			$builder->orLike('category.name', $textToFind);*/
			$query = $builder->get()->getResult();
		return $query;
	}

	public function eventList()
	{
		$db = \Config\Database::connect();
		$builder = $db->table('event');
		$query = $builder->get()->getResult();
		return $query;
	}
	public function searchEventMulti($textToFind)
	{
		$session = \Config\Services::session(); 
		$db = \Config\Database::connect();
		$builder = $db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,city.name as nameCity, place.name as namePlace,category.name as nameCategorie');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'city.idCity = place.idCity');
		if($_SESSION['userType'] != "admin"){
			$builder->where('organizer.idUser',$_SESSION['userId']);
		}
		$builder->like('event.name', $textToFind);
		$query = $builder->get()->getResult();
		return $query;
	}
	
	public function filterEvent($status,$category,$idOrganizer)
	{
		$session = \Config\Services::session(); 
		$db = \Config\Database::connect();
		$builder = $db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,city.name as nameCity, place.name as namePlace,category.name as nameCategorie');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'city.idCity = place.idCity');
		
		if($status == 5)
		{
			$builder->where('(NOW() > (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) OR NOW() > event.dateEnd )');
		}
		else
		{
			if($status != -1)
			{
				$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) ');
				$builder->where('NOW() <= event.dateEnd ');
			}
		}
		if($status != -1 && $status !=5 )
		{
			
			$builder->where('event.isValidated', $status);
		}
		if($category != -1 )
		{
			
			$builder->where('event.idCategory', $category);
		}
		if($idOrganizer != -1 )
		{
			if($idOrganizer != -2 ) $builder->where('organizer.idOrganizer', $idOrganizer);
			else $builder->where('organizer.idUser',$_SESSION['userId'] );
		}
		$query = $builder->get()->getResult();
		
		return $query;
	}
	public function eventListByIdOrg($id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('event');
		$builder->where('event.idOrganizer', $id);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function eventByIdEvent($id)
   	{
		return $this->asArray() ->where(['idEvent' => $id]) ->first();
	}
	public function eventById($id)
   	{
		$db = \Config\Database::connect();
		
		$builderPrice=$db->table('price');
		$builderPrice->select('name,value');
		$builderPrice->where('idEvent', $id);
		$queryPrice = $builderPrice->get()->getResult();
		foreach($queryPrice as $row)
		{
			if($row->value == 0 || $row->name =="Gratuit")
			{
				
				$builder=$db->table('event');
				$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
				$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
				$builder->join('place', 'event.idPlace = place.idPlace');
				$builder->join('city', 'place.idCity = city.idCity');
				$builder->join('category', 'event.idCategory = category.idCategory');
				$builder->where('event.idEvent', $id);
				$query = $builder->get()->getResult();
				return $query;

			}
			
		}
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,pointofsale.name as namePos,pointofsale.lat as latPos,pointofsale.lng as lngPos,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('ticket', 'event.idEvent = ticket.idEvent');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale');
		$builder->where('event.idEvent', $id);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function saveEvent($event)
	{
		/*$this->save($event);
		 $this->db->insertID();*/
		 
		$data = [
               'name' => $event->name ,'dateBegin' => $event->dateBegin ,'dateEnd' => $event->dateEnd ,'description' => $event->description ,
			   'idOrganizer' => $event->idOrganizer ,'idPlace' => $event->idPlace ,'idCategory' => $event->idCategory,
			   'image' => $event->image ,'isValidated' => $event->isValidated ,'affichageBan' => $event->affichageBan,
			   'nbJourSupplementaire' => $event->nbJourSupplementaire ,'dureeAffichage' => $event->dureeAffichage,
			   'dateDebutAffichage' => $event->dateDebutAffichage ,'dateFinAffichage' => $event->dateFinAffichage ,
			   'cout' => $event->cout  
            ];
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		
		$builder->insert($data); 

		$last_id = $db->insertID();
		return $last_id;
	}

	public function updateEvent($id,$event)
	{
		$this->update($id,$event);
	}
	public function deleteEvent($id)
	{
		$this->where('idEvent', $id)->delete();
	}

	
	public function eventDetailsOrganizer($idOrganizer)
	{
      $db = \Config\Database::connect();
    $builder=$db->table('event');
		$builder->select('event.*,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('event.idOrganizer', $idOrganizer);
		//$builder->where('NOW() < event.dateEnd ');
		$query = $builder->get()->getResult();
		return $query;	 
	}
	public function eventDetailsToValidateIdOrg()
	{
		
	}
	public function eventDetails($state,$typeList)
	{
      
      $db = \Config\Database::connect();
       if($typeList == 'notpublished')
     	{
			$builder=$db->table('event');
			$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
			$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
			$builder->join('place', 'event.idPlace = place.idPlace');
			$builder->join('city', 'place.idCity = city.idCity');
			$builder->join('category', 'event.idCategory = category.idCategory');
			$builder->where('NOW() not  BETWEEN event.dateDebutAffichage AND (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
			if($state == true) $builder->where('event.isValidated', 0);
			else $builder->where('event.isValidated', 1);
			$query = $builder->get()->getResult();
		}
		else if($typeList == 'toValidate')
		{
			$builder=$db->table('event');
			$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
			$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
			$builder->join('place', 'event.idPlace = place.idPlace');
			$builder->join('city', 'place.idCity = city.idCity');
			$builder->join('category', 'event.idCategory = category.idCategory');
			$builder->where('NOW() < event.dateEnd ');
			if($state == true) $builder->where('event.isValidated', 0);
			else $builder->where('event.isValidated', 1);
			$query = $builder->get()->getResult();
		}
		else{
			$builder=$db->table('event');
			$builder->select('event.*,(event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
			$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
			$builder->join('place', 'event.idPlace = place.idPlace');
			$builder->join('city', 'place.idCity = city.idCity');
			$builder->join('category', 'event.idCategory = category.idCategory');
			//$builder->where('NOW() < event.dateEnd ');
			$builder->where('event.isValidated != 3 ');
		//	if($state == true) $builder->where('event.isValidated', 0);
		//	else $builder->where('event.isValidated', 1);
			$query = $builder->get()->getResult();
		}
		return $query;	
	}
	
	
	public function eventDetailsws()
	{
      
      $db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,place.idCity,city.name as nameCity,city.idCity,city.name as nameCity,pointofsale.name as namePos,pointofsale.lat as latPos,pointofsale.lng as lngPos,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('ticket', 'event.idEvent = ticket.idEvent','left');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale','left');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('event.isValidated', 1);
		$query = $builder->get()->getResult();
		return $query;	 
	}
	
	public function eventDetailsByIdws($id)
	{
      
      $db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,place.idCity,city.name as nameCity,city.idCity,city.name as nameCity,pointofsale.name as namePos,pointofsale.lat as latPos,pointofsale.lng as lngPos,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('ticket', 'event.idEvent = ticket.idEvent','left');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale','left');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('event.isValidated', 1);
		$builder->where('event.idEvent', $id);
		$query = $builder->get()->getResult();
		return $query;	 
	}
	
	public function eventSearchByName($name,$dateEvent,$idCity,$idCategory,$idPlace,$idOrganizer)
	{
      
      $db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,place.idCity,city.name as nameCity,city.idCity,city.name as nameCity,pointofsale.name as namePos,pointofsale.lat as latPos,pointofsale.lng as lngPos,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('ticket', 'event.idEvent = ticket.idEvent','left');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('isValidated = 1');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale','left');
       if( isset( $name ) && !empty($name)) 
		{
			$builder->like('event.name', $name);
		}
		if( isset( $dateEvent ) && !empty($dateEvent)) 
		{
			$builder->where('MONTH(dateBegin) <=',$dateEvent);
			$builder->where('MONTH(dateEnd) >=',$dateEvent);
		
		}
		
		if( isset( $idOrganizer ) && !empty($idOrganizer)) 
		{
			$builder->where('event.idOrganizer', $idOrganizer);
		}
		if( isset( $idCategory) && !empty($idCategory)) 
		{
			$builder->where('event.idCategory', $idCategory);
		}
		if( isset( $idPlace ) && !empty($idPlace)) 
		{
			$builder->where('event.idPlace', $idPlace);
		}
		if( isset( $idCity ) && !empty($idCity)) 
		{
			$builder->where('place.idCity', $idCity);
		}
		
		
		$query = $builder->get()->getResult();
		return $query;	 
	}
	/*public function eventSearchByName($name)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->like('event.name', $name);
		$query = $builder->get()->getResult();
		return $query;		 
	}*/
	public function eventSearchByDate($dateEvent)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('isValidated = 1');
		$builder->where('dateBegin >=', $dateEvent);
		$builder->where('dateEnd <=', $dateEvent);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function eventSearchByOrganizer($idOrganizer)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('isValidated = 1');
		$builder->where('event.idOrganizer', $idOrganizer);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function countEventSearchByOrganizer($idOrganizer){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('count(event.idEvent) as nbEvents');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->where('event.idOrganizer', $idOrganizer);
		$query = $builder->get()->getResult();
		return $query;	

	}
	public function eventSearchByCategory($idCategory)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('isValidated = 1');
		$builder->where('event.idCategory', $idCategory);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	
	public function eventSearchByCategoryByIdOrganizer($idCategory,$idOrg)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('event.idCategory', $idCategory);
		$builder->where('event.idOrganizer', $idOrg);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function eventSearchByPlace($idPlace)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() <= (event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('isValidated = 1');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('event.idPlace', $idPlace);
		$query = $builder->get()->getResult();
		return $query;		 
	}

	public function eventSearchByCity($idCity)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('city', 'city.idCity = place.idCity');
		$builder->where('NOW() <= (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
       	$builder->where('NOW() <= event.dateEnd ');
		$builder->where('NOW() >= event.dateDebutAffichage ');
		$builder->where('isValidated = 1');
		$builder->where('place.idCity', $idCity);
		$query = $builder->get()->getResult();
		return $query;		 
	}


	public function eventSearch($chaine)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() BETWEEN event.dateDebutAffichage AND ((((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE))');
		$builder->orLike('event.name', $chaine);
		$builder->orLike('organizer.name', $chaine);
		$builder->orLike('place.name', $chaine);
		$builder->orLike('event.dateBegin', $chaine);
		$builder->orLike('event.dateEnd', $chaine);
		$builder->orLike('event.description', $chaine);
		$builder->orLike('category.name', $chaine);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function countUserByEvent($idEvent)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('agenda');
		$builder->select('event.*,count(agenda.idUser) as nbUsers');
		$builder->join('event', 'agenda.idEvent = event.idEvent');
		$builder->where('agenda.idEvent', $idEvent);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function eventListsSimilar($idEvent){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,organizer.name as nameOrganizer,place.name as placeName,category.name as nameCategory');
		$builder->where('NOW() BETWEEN event.dateDebutAffichage AND (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$builder->where('event.idCategory', $idCategory);
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$query = $builder->get()->getResult();
		return $query;	
	}

	public function eventLikeBO($id){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('likeevent', 'event.idEvent = likeevent.idEvent');
		$builder->where('likeevent.idUser', $id);
		$query = $builder->get()->getResult();
		return $query;		 
	}

	public function eventLike($id){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		//$builder->select('event.*');
		$builder->select('event.*,likeevent.idUser,place.idCity,city.name as nameCity,city.idCity,city.name as nameCity,pointofsale.name as namePos,pointofsale.lat as latPos,pointofsale.lng as lngPos,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->join('ticket', 'event.idEvent = ticket.idEvent','left');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale','left');
		$builder->join('likeevent', 'event.idEvent = likeevent.idEvent');
		$builder->where('NOW() BETWEEN event.dateDebutAffichage AND (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$builder->where('likeevent.idUser', $id);
			$query = $builder->get()->getResult();
		return $query;		 
	}
	
	
	/*
	$query = $builder->get()->getResult();*/


    public function countLike($idE){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('count(likeevent.idUser) as nbLike');
		$builder->join('likeevent', 'event.idEvent = likeevent.idEvent');
		$builder->where('likeevent.idEvent', $idE);
		//$builder->where('NOW() BETWEEN event.dateDebutAffichage AND (event.dateDebutAffichage + INTERVAL event.dureeAffichage+event.nbJourSupplementaire DAY)');
		$query = $builder->get()->getResult();
		return $query;		 
	}
	
	public function listLike(){
		$db = \Config\Database::connect();
		$builder=$db->table('likeevent');
		$builder->select('*');
		$query = $builder->get()->getResult();
		return $query;		 
	}

	public function validateEvent($idEvent){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->set('isValidated', 1);
		//$builder->set('dateDebutAffichage', date("Y-m-d"));
		$builder->where('idEvent', $idEvent); $builder->update();
	}
	public function updateDescImg($desc,$img,$idEvent){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->set('description', $desc);
		if($img!=null)$builder->set('image',$img);
		$builder->where('idEvent', $idEvent); $builder->update();
	}
	public function getLastEvent($event){
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*');
		$builder->where('name',$event->name);
		$builder->where('idOrganizer',$event->idOrganizer);
		$builder->where('idPlace',$event->idPlace);
		$builder->where('idCategory',$event->idCategory);
		$builder->where('dateBegin',$event->dateBegin);
		$builder->where('dateEnd',$event->dateEnd);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {	
			return $this->asArray() ->where(['name' => $row->name]) ->first();
		}
	}
	public function getEventRejected()
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() < (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$builder->where('event.isValidated', 4);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function getEventToValidate()
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() < (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$builder->where('event.isValidated', 0);
		$query = $builder->get()->getResult();
		return $query;
	}
	
	public function getEventRejectedByIdOrg($idOrg)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		//juste pour le test mais à decommenter
		//$builder->where('NOW() BETWEEN event.dateDebutAffichage AND (event.dateDebutAffichage + INTERVAL event.dureeAffichage+event.nbJourSupplementaire DAY)');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() < (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$builder->where('event.isValidated', 4);
		$builder->where('event.idOrganizer', $idOrg);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function getEventToValidateByIdOrg($idOrg)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		//juste pour le test mais à decommenter
		//$builder->where('NOW() BETWEEN event.dateDebutAffichage AND (event.dateDebutAffichage + INTERVAL event.dureeAffichage+event.nbJourSupplementaire DAY)');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() < (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$builder->where('event.isValidated', 0);
		$builder->where('event.idOrganizer', $idOrg);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function getEventNotPublished()
	{	
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() > (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE)');
		$query = $builder->get()->getResult();
		return $query;
	}
	public function getEventPublished()
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() <  (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) ');
		$builder->where('event.isValidated',1);
		$query = $builder->get()->getResult();
		return $query;
	}
	 
	public function getEventPublishedByIdOrg($idOrg)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() < (event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY)');
		$builder->where('event.isValidated',1);
		$builder->where('event.idOrganizer',$idOrg);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function getEventNotPublishedByIdOrg($idOrg)
	{	
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() > (event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY)');
		$builder->where('event.idOrganizer',$idOrg);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function eventUpdateState($idEvent,$statut)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->set('isValidated', $statut);
		$builder->where('idEvent', $idEvent);
		$builder->where('isValidated', '0');
		$builder->update();
	}
	public function checkIfExistTopEventInCity($idPlace)
	{	
		$db = \Config\Database::connect();
		//find City of idPlace
		$city = "";
		$builder=$db->table('city');
		$builder->select('city.*');
		$builder->join('place', 'place.idCity = city.idCity');
		$builder->where('place.idPlace',$idPlace);
		$query = $builder->get()->getResult();
		foreach($query as $r)
		{
			$city = $r->idCity;
		}
		
		$builder2=$db->table('event');
		$builder2->select('event.*, (event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) as finAffichage');
		$builder2->join('place', 'event.idPlace = place.idPlace');
		$builder2->join('city', 'place.idCity = city.idCity');
		$builder2->where('isValidated != 4');
		$builder2->where('city.idCity',$city);
		$builder2->where('event.affichageBan',1);
		$query1 = $builder2->get()->getResult();
		return $query1;
	}
	public function getEventByCatLp($idcat)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
		$builder->where('NOW() < event.dateEnd ');
		$builder->where('NOW() <  (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) ');
		$builder->where('event.isValidated',1);
		if($idcat != 0) $builder->where('event.idCategory',$idcat);
		$builder->where('event.affichageBan',1);
		//Top evenement 
		//limit 3
		//$builder->limit(1);
		$query = $builder->get()->getResult();
		return $query;
	}	
	public function getEventByCatLpLimit($idcat,$limit)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('event');
		$builder->select('event.*,(((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) as dateFinAffichage,city.idCity,city.name as nameCity,organizer.name as nameOrganizer,organizer.description as organizerDescription,organizer.phone,organizer.email,place.lat,place.lng,place.name as placeName,category.name as nameCategory');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->join('place', 'event.idPlace = place.idPlace');
		$builder->join('city', 'place.idCity = city.idCity');
		$builder->join('category', 'event.idCategory = category.idCategory');
	//	$builder->where('NOW() < event.dateEnd ');
	//	$builder->where('NOW() <  (((event.dateDebutAffichage + INTERVAL event.dureeAffichage DAY) + INTERVAL 23 HOUR ) + INTERVAL 59 MINUTE) ');
		$builder->where('event.isValidated',1);
		if($idcat != 0) $builder->where('event.idCategory',$idcat);
		$builder->where('event.affichageBan',0);
		$builder->orderBy('event.dateBegin','ASC');
		//Top evenement 
		//limit 3
		//$builder->limit($limit);
		$query = $builder->get()->getResult();
		return $query;
	}	
	public function getMinPrice($idEvent)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('price');
		$builder->where('price.idEvent',$idEvent);
		$builder->orderBy('price.value', 'ASC');
		$builder->limit(1);
		$query = $builder->get()->getResult();
		return $query;
	}
}