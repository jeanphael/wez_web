<?php namespace App\Controllers;
use App\Models\UserAcountModel;
use App\Entities\UserAcount;
use App\Models\OrganizerModel;
use App\Entities\Organizer;
use CodeIgniter\API\ResponseTrait;
use App\Models\AgendaModel;
use App\Entities\Agenda;
use App\Entities\Event;
use App\Models\PictureModel;
use App\Models\PriceModel;
use App\Models\EventModel;
use App\Models\LikeEventModel;


class EventWSController extends BaseController
{
	use ResponseTrait;
	public function index() { 
		$this->liste();
	} 
	
    public function liste()
	{
		$eventModel = new EventModel(); 
		$data = $eventModel->getAll();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function eventList()
	{
		$eventModel = new EventModel(); 
		$data = $eventModel->eventList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function eventById()
	{
		$eventModel = new EventModel(); 
		$idEvent = $this->request->getVar('idEvent');
		$data = $eventModel->eventById($idEvent);
		$arr = array('statut' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function saveEvent()
	{
		$event = new Event();
		$event->name = $this->request->getVar('name');
		$event->dateBegin = $this->request->getVar('dateBegin');
		$event->dateEnd = $this->request->getVar('dateEnd');
		$event->description = $this->request->getVar('description');
		$event->idOrganizer = $this->request->getVar('idOrganizer');
		$event->idPlace = $this->request->getVar('idPlace');
		$event->idPrice = $this->request->getVar('idPrice');
		$event->idCategory = $this->request->getVar('idCategory');
		$event->image = $this->request->getVar('image');
		$eventModel = new EventModel(); 
		$eventModel->save($event);
	}
	 public function updateEvent()
	{
		$eventModel = new EventModel(); 
		$event = new Event();
		$id = $this->request->getVar('idEvent');
		$event->name = $this->request->getVar('name');
		$event->dateBegin = $this->request->getVar('dateBegin');
		$event->dateEnd = $this->request->getVar('dateEnd');
		$event->description = $this->request->getVar('description');
		$event->idOrganizer = $this->request->getVar('idOrganizer');
		$event->idPlace = $this->request->getVar('idPlace');
		$event->idPrice = $this->request->getVar('idPrice');
		$event->idCategory = $this->request->getVar('idCategory');
		$event->image = $this->request->getVar('image');
		$eventModel->updateEvent($id,$event);
	}
	 public function deleteEvent()
	{
		$id = $this->request->getVar('id');
		$eventModel = new EventModel(); 
		$eventModel->deleteEvent($id);
	}
	 public function eventDetailsById()
	{
		$eventModel = new EventModel();
		
		$idEvent = $this->request->getVar('idEvent');
		$dataRes=$eventModel->eventDetailsByIdws($idEvent);		
		$eventList = array();
		foreach($dataRes as $row){
              $compteur = 0;
	            foreach($eventList as $rowEv){
	               if($rowEv['idEvent'] == $row->idEvent){ 
	                	$compteur = 1;
	                	break;
	                }
              	}
              if($compteur == 0){ 
                $anEvent = new Event();
                $anEvent->idEvent = $row->idEvent;
                $anEvent->name = $row->name;
                $anEvent->dateBegin = $row->dateBegin;
                $anEvent->dateEnd = $row->dateEnd;
                $anEvent->idCategory = $row->idCategory;
                $anEvent->image = $row->image;
                $anEvent->description = $row->description;
				$anEvent->affichageBan = $row->affichageBan;

                $organizer = ['idOrganizer'=> $row->idOrganizer,
                        'name' => $row->nameOrganizer,
                        'description' => $row->organizerDescription,
                        'phone' => $row->phone,
                        'email' => $row->email,
                         ]; 

                $place = ['idPlace'=> $row->idPlace,
                        'name' => $row->placeName,
                        'lat' => $row->lat,
                        'lng' => $row->lng,
                        'idCity' => $row->idCity,
                        'nameCity' => $row->nameCity,
                        ];

     
                $placeOfSale = array();

                foreach($dataRes as $rowE){
                  if($row->idEvent == $rowE->idEvent){
                    $pl = [
                        'name' => $rowE->namePos,
                        'lat' => $rowE->latPos,
                        'lng' => $rowE->lngPos,
                        ];
                    array_push($placeOfSale, $pl);
                  }
                }
                $priceModel = new PriceModel();
                $priceList = $priceModel->priceByEvent($anEvent->idEvent);
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'affichageBan'  => $anEvent->affichageBan,
                       'organisator'  => $organizer,
                        'placeEvent'  => $place,
                        'price'  => $priceList,
						 'placeOfSale' => $placeOfSale,
                    ]; 

                array_push($eventList, $event);
              }
          }

		$events = array_values($eventList);
		$arr = array('status' => 200,'message' =>'success','data'=> $eventList);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	
	public function eventDetails()
	{
		$eventModel = new EventModel();
		$dataRes=$eventModel->eventDetailsws();
        //$this->getListDetail($dataRes)
		$eventList = array();
		foreach($dataRes as $row){
              $compteur = 0;
	            foreach($eventList as $rowEv){
	               if($rowEv['idEvent'] == $row->idEvent){ 
	                	$compteur = 1;
	                	break;
	                }
              	}
              if($compteur == 0){ 
                $anEvent = new Event();
                $anEvent->idEvent = $row->idEvent;
                $anEvent->name = $row->name;
                $anEvent->dateBegin = $row->dateBegin;
                $anEvent->dateEnd = $row->dateEnd;
                $anEvent->idCategory = $row->idCategory;
                $anEvent->image = $row->image;
                $anEvent->description = $row->description;
				$anEvent->affichageBan = $row->affichageBan;

                $organizer = ['idOrganizer'=> $row->idOrganizer,
                        'name' => $row->nameOrganizer,
                        'description' => $row->organizerDescription,
                        'phone' => $row->phone,
                        'email' => $row->email,
                         ]; 

                $place = ['idPlace'=> $row->idPlace,
                        'name' => $row->placeName,
                        'lat' => $row->lat,
                        'lng' => $row->lng,
                        'idCity' => $row->idCity,
                        'nameCity' => $row->nameCity,
                        ];

     
                $placeOfSale = array();

                foreach($dataRes as $rowE){
                  if($row->idEvent == $rowE->idEvent){
                    $pl = [
                        'name' => $rowE->namePos,
                        'lat' => $rowE->latPos,
                        'lng' => $rowE->lngPos,
                        ];
                    array_push($placeOfSale, $pl);
                  }
                }
                $priceModel = new PriceModel();
                $priceList = $priceModel->priceByEvent($anEvent->idEvent);
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'affichageBan'  => $anEvent->affichageBan,
                       'organisator'  => $organizer,
                        'placeEvent'  => $place,
                        'price'  => $priceList,
						 'placeOfSale' => $placeOfSale,
                    ]; 

                array_push($eventList, $event);
              }
          }

		$events = array_values($eventList);
		$arr = array('status' => 200,'message' =>'success','data'=> $eventList);
		header('Content-Type:application/json');
		echo json_encode($arr);
		
	}
	public function getListDetail($dataRes)
	{
		$eventList = array();
		foreach($dataRes as $row){
              $compteur = 0;
	            foreach($eventList as $rowEv){
	               if($rowEv['idEvent'] == $row->idEvent){ 
	                	$compteur = 1;
	                	break;
	                }
              	}
              if($compteur == 0){ 
                $anEvent = new Event();
                $anEvent->idEvent = $row->idEvent;
                $anEvent->name = $row->name;
                $anEvent->dateBegin = $row->dateBegin;
                $anEvent->dateEnd = $row->dateEnd;
                $anEvent->idCategory = $row->idCategory;
                $anEvent->image = $row->image;
                $anEvent->description = $row->description;
				$anEvent->affichageBan = $row->affichageBan;

                $organizer = ['idOrganizer'=> $row->idOrganizer,
                        'name' => $row->nameOrganizer,
                        'description' => $row->organizerDescription,
                        'phone' => $row->phone,
                        'email' => $row->email,
                         ]; 

                $place = ['idPlace'=> $row->idPlace,
                        'name' => $row->placeName,
                        'lat' => $row->lat,
                        'lng' => $row->lng,
                        'idCity' => $row->idCity,
                        'nameCity' => $row->nameCity,
                        ];

     
                $placeOfSale = array();

                foreach($dataRes as $rowE){
                  if($row->idEvent == $rowE->idEvent){
                    $pl = [
                        'name' => $rowE->namePos,
                        'lat' => $rowE->latPos,
                        'lng' => $rowE->lngPos,
                        ];
                    array_push($placeOfSale, $pl);
                  }
                }
                $priceModel = new PriceModel();
                $priceList = $priceModel->priceByEvent($anEvent->idEvent);
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'organisator'  => $organizer,
                        'placeEvent'  => $place,
                        'price'  => $priceList,
						'affichageBan'  => $anEvent->affichageBan,
                        'placeOfSale' => $placeOfSale,
                    ]; 

                array_push($eventList, $event);
              }
          }

		$events = array_values($eventList);
		$arr = array('status' => 200,'message' =>'success','data'=> $eventList);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	
	public function eventSearchByName()
	{
		$eventModel = new EventModel(); 
		$name = $this->request->getVar('name');
		$dateEvent = $this->request->getVar('dateEvent');
		$idCity = $this->request->getVar('idCity'); 
	
		$idCategory = $this->request->getVar('idCategory'); 
		$idPlace = $this->request->getVar('idPlace');
		$idOrganizer = $this->request->getVar('idOrganizer');
		$dataRes=$eventModel->eventSearchByName($name,$dateEvent,$idCity,$idCategory,$idPlace,$idOrganizer);
		$eventList = array();
		foreach($dataRes as $row){
              $compteur = 0;
	            foreach($eventList as $rowEv){
	               if($rowEv['idEvent'] == $row->idEvent){ 
	                	$compteur = 1;
	                	break;
	                }
              	}
              if($compteur == 0){ 
                $anEvent = new Event();
                $anEvent->idEvent = $row->idEvent;
                $anEvent->name = $row->name;
                $anEvent->dateBegin = $row->dateBegin;
                $anEvent->dateEnd = $row->dateEnd;
                $anEvent->idCategory = $row->idCategory;
                $anEvent->image = $row->image;
                $anEvent->description = $row->description;
				$anEvent->affichageBan = $row->affichageBan;

                $organizer = ['idOrganizer'=> $row->idOrganizer,
                        'name' => $row->nameOrganizer,
                        'description' => $row->organizerDescription,
                        'phone' => $row->phone,
                        'email' => $row->email,
                         ]; 

                $place = ['idPlace'=> $row->idPlace,
                        'name' => $row->placeName,
                        'lat' => $row->lat,
                        'lng' => $row->lng,
                        'idCity' => $row->idCity,
                        'nameCity' => $row->nameCity,
                        ];

     
                $placeOfSale = array();

                foreach($dataRes as $rowE){
                  if($row->idEvent == $rowE->idEvent){
                    $pl = [
                        'name' => $rowE->namePos,
                        'lat' => $rowE->latPos,
                        'lng' => $rowE->lngPos,
                        ];
                    array_push($placeOfSale, $pl);
                  }
                }
                $priceModel = new PriceModel();
                $priceList = $priceModel->priceByEvent($anEvent->idEvent);
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'organisator'  => $organizer,
                        'placeEvent'  => $place,
                        'price'  => $priceList,
						'affichageBan'  => $anEvent->affichageBan,
                        'placeOfSale' => $placeOfSale,
                    ]; 

                array_push($eventList, $event);
              }
          }

		$events = array_values($eventList);
		$arr = array('status' => 200,'message' =>'success','data'=> $eventList);
		header('Content-Type:application/json');
		echo json_encode($arr);
	
	} 
	
	/*public function eventSearchByName()
	{
		$eventModel = new EventModel(); 
		$name = $this->request->getVar('name');
		$data=$eventModel->eventSearchByName($name);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}*/
	 public function eventSearchByDate()
	{
		$eventModel = new EventModel(); 
		$dateEvent = $this->request->getVar('dateEvent');
		$data=$eventModel->eventSearchByDate($dateEvent);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function eventSearchByOrganizer()
	{
		$eventModel = new EventModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data=$eventModel->eventSearchByOrganizer($idOrganizer);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	
	 public function eventSearchByPlace()
	{
		$eventModel = new EventModel();
		$idPlace = $this->request->getVar('idPlace'); 
		$data=$eventModel->eventSearchByPlace($idPlace);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function eventSearchByCity()
	{
		$eventModel = new EventModel();
		$idCity = $this->request->getVar('idCity'); 
		$data=$eventModel->eventSearchByCity($idCity);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function eventSearchByCategory()
	{
		$eventModel = new EventModel();
		$idCategory = $this->request->getVar('idCategory'); 
		$data=$eventModel->eventSearchByCategory($idCategory);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

	public function eventSearch()
	{
		$eventModel = new EventModel(); 
		$chaine = $this->request->getVar('chaine');
		$data=$eventModel->eventSearch($chaine);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function countUserByEvent()
	{
		$eventModel = new EventModel(); 
		$idEvent = $this->request->getVar('idEvent');
		$data=$eventModel->countUserByEvent($idEvent);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

	public function countLike(){
		$eventModel = new EventModel(); 
		$idEvent = $this->request->getVar('idEvent');
		$data=$eventModel->countLike($idEvent);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

	public function likeEvent(){
		$likeModel = new LikeEventModel(); 
		$idEvent = $this->request->getVar('idEvent');
		$idUser = $this->request->getVar('idUser');
		$data=$likeModel->like($idEvent,$idUser);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	
	public function searchLikeByIdUser(){
       		$eventModel = new EventModel();
	      	$dataRes = $eventModel->eventLike($_POST['id']);
		  $eventList = array();
		foreach($dataRes as $row){
              $compteur = 0;
	            foreach($eventList as $rowEv){
	               if($rowEv['idEvent'] == $row->idEvent){ 
	                	$compteur = 1;
	                	break;
	                }
              	}
              if($compteur == 0){ 
                $anEvent = new Event();
                $anEvent->idEvent = $row->idEvent;
                $anEvent->name = $row->name;
                $anEvent->dateBegin = $row->dateBegin;
                $anEvent->dateEnd = $row->dateEnd;
                $anEvent->idCategory = $row->idCategory;
                $anEvent->image = $row->image;
                $anEvent->description = $row->description;
				$anEvent->affichageBan = $row->affichageBan;

                $organizer = ['idOrganizer'=> $row->idOrganizer,
                        'name' => $row->nameOrganizer,
                        'description' => $row->organizerDescription,
                        'phone' => $row->phone,
                        'email' => $row->email,
                         ]; 

                $place = ['idPlace'=> $row->idPlace,
                        'name' => $row->placeName,
                        'lat' => $row->lat,
                        'lng' => $row->lng,
                        'idCity' => $row->idCity,
                        'nameCity' => $row->nameCity,
                        ];

     
                $placeOfSale = array();

                foreach($dataRes as $rowE){
                  if($row->idEvent == $rowE->idEvent){
                    $pl = [
                        'name' => $rowE->namePos,
                        'lat' => $rowE->latPos,
                        'lng' => $rowE->lngPos,
                        ];
                    array_push($placeOfSale, $pl);
                  }
                }
                $priceModel = new PriceModel();
                $priceList = $priceModel->priceByEvent($anEvent->idEvent);
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'organisator'  => $organizer,
                        'placeEvent'  => $place,
                        'price'  => $priceList,
						'affichageBan'  => $anEvent->affichageBan,
                        'placeOfSale' => $placeOfSale,
                    ]; 

                array_push($eventList, $event);
              }
          }

		$events = array_values($eventList);
		$arr = array('status' => 200,'message' =>'success','data'=> $eventList);
		header('Content-Type:application/json');
		echo json_encode($arr);
	
    }
	
	public function getIDEventByIdUser(){
		$eventModel = new LikeEventModel();
	   $dataRes = $eventModel->getIDEventByIdUser($_POST['id']);
	   $data = array();
	   foreach($dataRes as $row){
		array_push($data , $row->idEvent);
	   }
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);

}
public function listLike(){
	$eventModel = new EventModel();
	   $data = $eventModel->listLike();
	  		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);

}

public function fbDelection(){
	/*$arr = array('status' => 200,'message' =>'success','data'=> null);
	header('Content-Type:application/json');
	echo json_encode($arr);
	return;*/
	
header('Content-Type: application/json');

$signed_request = $_POST['signed_request'];

log_message('error', 'fb delection begin. voici le params : '.$signed_request);
//$signed_request = 'smsmslkfjm smdlfskfmskfj';

$data = $this->parse_signed_request($signed_request);
//echo json_encode($signed_request);
$status_url = 'https://wez.mg/services/config/deletion?id=abc123'; // URL to track the deletion
$confirmation_code = 'abc123'; // unique code for the deletion request

$data = array(
  'url' => $status_url,
  'confirmation_code' => $confirmation_code
);
$user_id = $data['user_id'];
echo json_encode($data);
}

function parse_signed_request($signed_request) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2);

  $secret = "bd9f6488851fe85b4302838dd1998af8"; // Use your app secret here
  
  // decode the data
  $sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
  
  $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

  // confirm the signature
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }
return $data;
}
function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}


}