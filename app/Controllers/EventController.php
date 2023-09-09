<?php namespace App\Controllers;
use App\Models\EventModel;
use App\Entities\Event;
use App\Models\OrganizerModel;
use App\Models\CategoryModel;
use App\Entities\Organizer;
use App\Models\PriceModel;
use App\Entities\Price;
use App\Entities\Category;
use App\Models\PlaceModel;
use App\Models\CityModel;
use App\Entities\City;
use App\Entities\Place;
use App\Models\PointOfSaleModel;
use App\Entities\Token;
use App\Models\TokenModel;
use App\Entities\Ticket;
use App\Models\TicketModel;
use App\Entities\PrintPrice;
use App\Models\PrintPriceModel;
use App\Entities\CommentEvent;
use App\Models\CommentEventModel;
use DateInterval;
use DateTime;
use CodeIgniter\I18n\Time;

class EventController extends BaseController
{
	public function pagination() {
		$index = $this->request->getVar('currentIndex');
		if($index === null){
			$index = 0;
		}
        $eventModel = new EventModel(); 
        $allEvent = $eventModel->getEventToValidate();
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
		echo "----".$index."--------";
		var_dump($pointOfSaleList[$index]);
		//return;
		$data['currentEvent'] =$pointOfSaleList[$index];
		if($index<count($allEvent))
		{
			$data['hasNext'] =true;
		}
		if($index>0)
		{
			$data['hasPrevious'] =true;
		}
		$data['currentIndex'] =$index;
        
        return view('pagination', $data);
    }
	public function eventUpdateState()
	{
		try {
			$session = \Config\Services::session(); 
			$eventModel = new EventModel(); 
			$id = $this->request->getVar('idEvent');
			$comment = $this->request->getVar('comment');
			
			if($_SESSION['userType'] == "admin") $eventModel->eventUpdateState($id,4);
			$idUser = $_SESSION['userId'] ;
			
			$eventCommentModel = new CommentEventModel();
			$eventComment = new CommentEvent();
			$eventComment->idEvent = $id;
			$eventComment->comment = $comment ;
			$eventComment->idUser = $idUser;
			$eventComment->datecomment = "NOW()";
			//var_dump($eventComment); return;
			$eventCommentModel->saveComm($eventComment);
			//$res = $eventCommentModel->eventCommentSave($eventComment);
			if($_SESSION['userType'] == "admin") return redirect()->to(base_url('evenement-list-refonte'));
			else return redirect()->to(base_url('evenement/info?iE='.$id));
		} catch (Exception $e) {
			echo 'Exception reçue : ',  $e->getMessage(), "\n";
			}
	} 
	public function updateEventRefonte()
	{
		$id = $this->request->getVar('idEvent');
		$eventModel = new EventModel();
		$current = (object)$eventModel->eventByIdEvent($id);
		
		// si statut = publié , seulement description et image qu on peut modifier
		if($current->isValidated == 1)
		{
			$description = $this->request->getVar('description');
			if(basename($_FILES["image"]["name"])!=base_url('assets/img/').$current->image)
			{
				$target_dir = 'assets/img/';
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				  echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				}
				else {
				  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
					$image = base_url($target_file);
				  } else {
					echo "Sorry, there was an error uploading your file.";
				  }
				}
			}
			else $image = null;
			// update desc and img
			$eventModel->updateDescImg($description,$image,$id);
			return redirect()->to(base_url('evenement-list-refonte'));
		}
		else{
			$event = new Event();
			$dateBeginPublished = $this->convertDateFormat( $this->request->getVar('dateBeginPublished'),"00:00");
			$dateEndPublished = $this->convertDateFormat( $this->request->getVar('dateEndPublished'),"23:59"); 
			$dateBeginEvent = $this->convertDateFormat( $this->request->getVar('dateBegin'),$this->request->getVar('timeBegin'));
			$dateEndEvent = $this->convertDateFormat( $this->request->getVar('dateEnd'),$this->request->getVar('timeEnd'));
			
			$event->dateBegin = $dateBeginEvent;
			$event->dateEnd = $dateEndEvent;

			
			$event->name = $this->request->getVar('nom');
			$event->description = $this->request->getVar('description');
			$session = \Config\Services::session();   
			if($_SESSION['userType'] == "admin")
			{
				$event->idOrganizer = $this->request->getVar('idOrganizer');
			}
			else{
				$event->idOrganizer = $_SESSION['idOrganizer'] ;
			}
			$event->idPlace = $this->request->getVar('lieu');
			var_dump($this->request->getVar('lieu'));
			$event->idCategory = $this->request->getVar('category');
			$listPdv = $this->request->getVar('pdv_selected');
			$affichage =$this->request->getVar('isban');
			$event->dureeAffichage = $this->request->getVar('nbJour');
			$printPriceModel = new PrintPriceModel();
			$printPrice = (object)$printPriceModel->priceFirst();
			if(isset($affichage)){
				$event->affichageBan = 1;
				$event->cout = $event->dureeAffichage * $printPrice->banniere;
			}
			else {
				$event->affichageBan = 0;
				$event->cout = $event->dureeAffichage * $printPrice->normal;
			}
			$event->image = $this->request->getVar('imageLastName');
			$tmodel = new TicketModel();
			$trfmodel = new PriceModel();
			$event->dateDebutAffichage = $dateBeginPublished;
			$event->nbJourSupplementaire  = 0;
			$tmodel->deletePdvByIdEvent($id);
			$listPdv = $this->request->getVar('pdv_selected');
			if($this->request->getVar('gratuit')!="on") 
			{
				if($listPdv != null)
				{
					foreach($listPdv as $rowpdv)
					{
						$tick = new Ticket();
						$tick->idEvent = $id;
						$tick->idPointOfSale = $rowpdv;
						$tmodel->save($tick);
					}	
				}
			}
			$trfmodel->deleteTrfByIdEvent($id);
			if($this->request->getVar('gratuit')=="on") 
			{
				$aprice = new Price();
				$aprice->idEvent = $id;
				$aprice->name = "Gratuit";
				$aprice->value =  "0";
				$pricemod = new PriceModel();
				$pricemod->save($aprice);
			}
			else
			{
				$lstprice = $this->request->getVar('listTarif');
				if($lstprice!=null){
					$pricemod = new PriceModel();
					foreach($lstprice as $rowtrf)
					{
						$aprice = new Price();
						$aprice->idEvent = $id;
						$aprice->name = explode(":", $rowtrf)[0];
						$aprice->value = explode(":", $rowtrf)[1];
						$pricemod->save($aprice);
					}
				}
			}

			$target_dir = 'assets/img/';
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			  $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			}
			else {
			  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
				$event->image = base_url($target_file);
			  } else {
				echo "Sorry, there was an error uploading your file.";
			  }
			}
			
			//$event->cout = $current->cout ;
			$button = $this->request->getVar('buttonSubmit');
			//si rejeté
			if($current->isValidated == 4) $event->isValidated = 0;
			//Si brouillon
			if($current->isValidated == 3 && $button=="Enregistrer en brouillon") $event->isValidated=3;
			if($current->isValidated == 3 && $button=="Envoyer pour validation")$event->isValidated=0;
			//SI publié
			if($current->isValidated == 1) $event->isValidated=1;
			//si en attente de validation
			
			
			$eventModel->updateEvent($id,$event);
			return redirect()->to(base_url('evenement-list-refonte'));
		}
			
	}
	public function convertDateFormat($date,$time)
	{
    	$newDate = date("Y-m-d", strtotime($date));  
    	return $newDate. " ".$time.":00";
	}
	public function saveRefont()
	{
		$event = new Event();
		$event->name = $this->request->getVar('nom');
		$dateBeginPublished = $this->convertDateFormat( $this->request->getVar('dateBeginPublished'),"00:00");
		$dateEndPublished = $this->convertDateFormat( $this->request->getVar('dateEndPublished'),"23:59");
		$dateBeginEvent = $this->convertDateFormat( $this->request->getVar('dateBegin'),$this->request->getVar('timeBegin'));
		$dateEndEvent = $this->convertDateFormat( $this->request->getVar('dateEnd'),$this->request->getVar('timeEnd'));

      	$event->dateBegin = $dateBeginEvent;
		$event->dateEnd = $dateEndEvent;
		
		
		$event->description = $this->request->getVar('description');
		/**/ 		
		$session = \Config\Services::session();   
		if($_SESSION['userType'] == "admin")
		{
			$event->idOrganizer = $this->request->getVar('idOrganizer');
		}
		else{
			$event->idOrganizer = $_SESSION['idOrganizer'] ;
		}
			
				
		$event->idPlace = $this->request->getVar('lieu');
		$event->idCategory = $this->request->getVar('category');
		$listPdv = $this->request->getVar('pdv_selected');

		$affichage = $this->request->getVar('isban');
		$event->dureeAffichage = $this->request->getVar('nbJour');
		$printPriceModel = new PrintPriceModel();
		$printPrice = (object)$printPriceModel->priceFirst();
		if(isset($affichage)){
			$event->affichageBan = 1;
			$event->cout = $event->dureeAffichage * $printPrice->banniere;
		}
		else {
			$event->affichageBan = 0;
			$event->cout = $event->dureeAffichage * $printPrice->normal;
		}
	
		$event->dateDebutAffichage = $dateBeginPublished;
		$event->nbJourSupplementaire  = 0;
		
		$eventModel = new EventModel(); 
		$target_dir = 'assets/img/';
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}	
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		}
		else
		{
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
			{
				echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			} else
			{
				echo "Sorry, there was an error uploading your file.";
			}
			$event->image = base_url($target_file); 
			$event->isValidated = 0;
			$buttonSubmit = $this->request->getVar("buttonsubmit");
			if($buttonSubmit=="Enregistrer en brouillon") 
			{
				$event->isValidated = 3;
			}
			if($_SESSION['userType'] == "admin")
			{
				$event->isValidated = 1;
				$event->dateDebutAffichage = $dateBeginPublished;
			}
		
			$insertdata = $eventModel->saveEvent($event); 
			echo $insertdata;
			
			if($insertdata != 0)
			{
				if($_SESSION['userType'] == "admin")
				{
					$this->sendNotification($insertdata,$event->name,$event->description);
				}
				//Saving pdv
				if($listPdv != null)
				{
					$tmodel = new TicketModel();
					foreach($listPdv as $rowpdv){
						$tick = new Ticket();
						$tick->idEvent = $insertdata;
						$tick->idPointOfSale = $rowpdv;
						$tmodel->save($tick);
					}
				}
			
				//Saving price
				if($this->request->getVar('gratuit')=="on") 
				{
					$aprice = new Price();
					$aprice->idEvent = $insertdata;
					$aprice->name = "Gratuit";
					$aprice->value =  "0";
					$pricemod = new PriceModel();
					$pricemod->save($aprice);
					var_dump($aprice);		
				}
				else
				{
					$lstprice = $this->request->getVar('listTarif');
					if($lstprice!=null){
						
						$pricemod = new PriceModel();
						foreach($lstprice as $rowtrf)
						{
							$aprice = new Price();
							$aprice->idEvent = $insertdata;
							$aprice->name = explode(":", $rowtrf)[0];
							$aprice->value = explode(":", $rowtrf)[1];
							$pricemod->save($aprice);
						}
					}
					else	
					{
						$aprice = new Price();
						$aprice->idEvent = $insertdata;
						$aprice->name = "Gratuit";
						$aprice->value =  "0";
						$pricemod = new PriceModel();
						$pricemod->save($aprice);
					}
				}
			}
			
			return redirect()->to(base_url('evenement-list-refonte'));
			
		}
	}

	public function eventFilter()
	{
		
		$eventModel = new EventModel(); 
		$status = $this->request->getVar('status');
		$category = $this->request->getVar('category');
		$idOrganizer = $this->request->getVar('organizer');
		
	//$data=$eventModel->searchEventMulti($textToFind);
	//var_dump($status,$category,$idOrganizer);
		
		$data=$eventModel->filterEvent($status,$category,$idOrganizer);
		echo json_encode($data);
	}

	public function eventSearchMulti()
	{
		$eventModel = new EventModel(); 
		$textToFind = $this->request->getVar('textToFind');
		$status = $this->request->getVar('status');
		$category = $this->request->getVar('category');
		$idOrganizer = $this->request->getVar('organizer');
		$data=$eventModel->searchEventMulti($textToFind);
		echo json_encode($data);
	}

	//debut refonte
	public function listeRefonte()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(0,false);
			$data['event'] = $eventList;
			if($_SESSION['userType']=="admin") $data['nocolumnValidate'] = 1;
			$events = array_values($eventList);
			$eventModel = new EventModel(); 
			$data = $this->getDataMenu($data);
			$pointOfSaleModel = new PointOfSaleModel(); 
			$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
			$data['pointOfSaleList'] = $pointOfSaleList;
			/*$statusList = array();
            array_push($statusList, $event);*/
			$catModel = new CategoryModel(); 
			$data['categoryList'] = $catModel->categoryList();
			$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
				
			
			echo view('evenement_liste_refonte', $data);
	  	 }
	  	else{
			if(isset($_COOKIE['cookname'])) {
				$eventList = $this->getListEventByDetail(0,false);
				$data['event'] = $eventList;
				if($_COOKIE['userType']=="admin") $data['nocolumnValidate'] = 1;
				$events = array_values($eventList);
				$eventModel = new EventModel(); 
				$data = $this->getDataMenuCook($data);
				$pointOfSaleModel = new PointOfSaleModel(); 
				$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
				$data['pointOfSaleList'] = $pointOfSaleList;
				$catModel = new CategoryModel(); 
				$data['categoryList'] = $catModel->categoryList();
				$organiserModel = new OrganizerModel(); 
				$data['organizerList'] = $organiserModel->organizerList();
				echo view('evenement_liste_refonte', $data);
			}
	  		else return redirect()->to(base_url('connexion'));
	  	 }
		
	}

		public function listePageEvent()
		{
			$eventModel = new EventModel(); 
			$pointOfSaleModel = new PointOfSaleModel(); 
			$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
			$data['pointOfSaleList'] = $pointOfSaleList;
			$data['listEventsToValidate'] = $eventModel->getEventToValidate();
			$data['listEventsNotPublished'] = $eventModel->getEventNotPublished();
			echo view('evenement_liste_refonte', $data);
		}
	//fin refonte

	public function index() { 
		$this->liste();
	} 

	
	public function getListEventByDetail($idEvent,$state) { 
		$eventModel = new EventModel(); 
		$eventList = array();
		if($idEvent == 0)
		{
			$session = \Config\Services::session();   
      		if($_SESSION['userType'] == "admin")
			{
				$dataRes=$eventModel->eventDetails($state,"");
			}
			else
			{
				$dataRes=$eventModel->eventDetailsOrganizer($session->idOrganizer);
			}
		}
		else if($idEvent == -1000){
			$session = \Config\Services::session();   
      		if($_SESSION['userType'] == "admin")
			{
				$dataRes=$eventModel->eventDetails(false,"notpublished");
			}
		} 
		else if($idEvent == -2000){
			$session = \Config\Services::session();   
      		if($_SESSION['userType'] == "admin")
			{
				$dataRes=$eventModel->eventDetails($state,"toValidate");
			}
		}
		else if($idEvent == -3000){
			$session = \Config\Services::session();   
      		if($_SESSION['userType'] == "admin")
			{
				$dataRes=$eventModel->getEventPublished();
			}
			else $dataRes=$eventModel->getEventPublishedByIdOrg($_SESSION['idOrganizer']);
		}
		else if($idEvent == -4000){
			$session = \Config\Services::session();   
      		if($_SESSION['userType'] == "admin")
			{
				$dataRes=$eventModel->getEventNotPublished();
			}
			else $dataRes=$eventModel->getEventNotPublishedByIdOrg($_SESSION['idOrganizer']);
		}		
		else if($idEvent == -5000){
			$session = \Config\Services::session();   
      		if($_SESSION['userType'] == "admin")
			{
				$dataRes=$eventModel->getEventRejected();
			}
			else $dataRes=$eventModel->getEventRejectedByIdOrg($_SESSION['idOrganizer']);
		}		
		 else{
			$dataRes=$eventModel->eventById($idEvent);
		}
		
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
                        ];

               /* $price = ['idPrice'=> $row->idPrice,
                        'classic' => $row->classic,
                        'silver' => $row->silver,
                        'premium' => $row->premium,
                        ]; */

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
                $countLike=$eventModel->countLike($row->idEvent);
                foreach($countLike as $c) $nbLike = $c->nbLike;
                
				$tarifs = array();
				$priceModel = new PriceModel(); 
                $tarifList = $priceModel->priceByEvent($row->idEvent);
                if(!empty($tarifList)) {
					foreach($tarifList as $rowT){
					  	$tarf = ['idPlace'=> $rowT->idPrice,
							'valueOfPrice' => $rowT->value,
							'namePrice' => $rowT->name,
							];
						array_push($tarifs, $tarf);
					}
				}
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'organisator'  => $organizer,
                        'placeName'  => $row->placeName,
                        'nameCity'  => $row->nameCity,
                        'nameOrganizer'  => $row->nameOrganizer,
                        'nameCategory'  => $row->nameCategory,
                        'price'  => $price,
                        'placeOfSale' => $placeOfSale,
                        'nbLike' => $nbLike,
						'tarif' => $tarifs,
						'isValidated' => $row->isValidated,
						'dureeAffichage' => $row->dureeAffichage,
						'dateDebutAffichage' => $row->dateDebutAffichage,
						'dateEnd' => $row->dateEnd,
                    ]; 
                array_push($eventList, $event);
              }
          }
		  return $eventList;
	} 



public function gestionPrixAffichage()
   {

  		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE && ($_SESSION['userType']=="admin")){
	  		$printPriceModel = new PrintPriceModel();
	  		$data['printPrice'] = (object)$printPriceModel->priceFirst();
	  		//var_dump($data);
	    	echo view('event_affichage_type',$data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}

	public function ajoutPrixAffichage()
   {

   		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE && ($_SESSION['userType']=="admin")){

	  		$printPrice= new PrintPrice();
	   		$printPrice->name = "default";
			$printPrice->banniere = $this->request->getVar('bann');
			$printPrice->normal = $this->request->getVar('normal');
			$printPriceModel= new PrintPriceModel();
			$printPriceModel->savePrice($printPrice); 
	    	$printPriceModel = new PrintPriceModel();

	  		$data['printPrice'] = (object)$printPriceModel->priceFirst();
	  		$data['message'] = "Modification effectuée";
	    	echo view('event_affichage_type',$data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}

	public function updatePrixAffiage()
   {

  		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE && ($_SESSION['userType']=="admin")){

	  		$printPrice= new PrintPrice();
	   		$printPrice->name = "default";
	   		$id = $this->request->getVar('id');
			$printPrice->banniere = $this->request->getVar('bann');
			$printPrice->normal = $this->request->getVar('normal');
			$printPriceModel= new PrintPriceModel();
			$printPriceModel->updatePrice($id,$printPrice); 
	    	$printPriceModel = new PrintPriceModel();

	  		$data['printPrice'] = (object)$printPriceModel->priceFirst();
	  		$data['message'] = "Modification effectuée";
	    	echo view('event_affichage_type',$data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}
  public function liste()
   {

  		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(0,false);
			$data['events'] = $eventList;
			if($_SESSION['userType']=="admin") $data['nocolumnValidate'] = 1;
			$events = array_values($eventList);
	    	echo view('evenement_liste', $data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}
	 public function listeToValidate()
   {

  		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(-2000,true);
			$data['events'] = $eventList;
			$events = array_values($eventList);
	    	echo view('evenement_liste', $data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}
	public function getListEventsnotPublished()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(-1000,false);
			$data['events'] = $eventList;
			$data['notpublished'] = 1;
			$events = array_values($eventList);
	    	echo view('evenement_liste', $data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}
  
	public function ajout()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
		  	$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
			$priceModel = new PriceModel(); 
			$data['priceList'] = $priceModel->priceList();
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeList();
			$catModel = new CategoryModel(); 
			$data['categoryList'] = $catModel->categoryList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$PointOfSaleModel = new PointOfSaleModel(); 
			$data['pdvList'] = $PointOfSaleModel->pointOfSaleList();
			
			$printPriceModel = new PrintPriceModel();
	  		$data['printPrice'] = (object)$printPriceModel->priceFirst();
	  		

			echo view('evenement_ajout',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}
	public function getSimilarEvent()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			 $categoryModel = new CategoryModel();
			$eventModel = new EventModel();
			$listCat = $categoryModel->categoryList();
			$listCatToView =  array();
			foreach ($listCat as $cat) {
				$uncategorie = new Category();
				$uncategorie->idCategory = $cat['idCategory'];
				$uncategorie->name = $cat['name'];
				$listEvents =  array();
				if($session->userType == "admin"){
					$listEvents = $eventModel->eventSearchByCategory($uncategorie->idCategory);
				}
				else{
					$listEvents = $eventModel->eventSearchByCategoryByIdOrganizer($uncategorie->idCategory,$session->idOrganizer);
				}
				$uncategorie->listEvents = $listEvents;
				array_push($listCatToView,$uncategorie);
			}
			$data['categories'] = $listCatToView;
			echo view('evenement_similaire',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}

	public function getListSimilarEventByCategory(){
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventModel = new EventModel();
			if($session->userType == "admin"){
				$data['events'] = $eventModel->eventSearchByCategory($_GET['idCategory']);
			}
			else{
				$data['events'] = $eventModel->eventSearchByCategoryByIdOrganizer($_GET['idCategory'],$session->idOrganizer);
			}
			echo view('evenement_liste_specifique', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}

	public function getListEventByOrganizer(){
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$eventModel = new EventModel();
			$data['events']  = $eventModel->eventSearchByOrganizer($_GET['idOrganizer']);
			echo view('evenement_liste_specifique', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}

	public function getById($id)
	{
		$eventModel = new EventModel(); 
		$data['event'] = $eventModel->eventById($id);
		echo view('evenement_liste', $data);
	}

	public function saveEvent($name,$dateBegin,$dateEnd,$description
	,$idOrganizer,$idPlace,$idPrice,$idCategory,$image)
	{
		$eventModel = new EventModel(); 
		$eventModel->name = $name;
		$eventModel->dateBegin = $dateBegin;
		$eventModel->dateEnd = $dateEnd;
		$eventModel->description = $description;
		$eventModel->idOrganizer = $idOrganizer;
		$eventModel->idPlace = $idPlace;
		$eventModel->idPrice = $idPrice;
		$eventModel->idCategory = $idPrice;
		$eventModel->image = $image;
		$eventModel->saveEvent();
		echo view('evenement_liste', $data);
	}
	

	public function save()
	{
		$event = new Event();
		$event->name = $this->request->getVar('nameEvent');
		
		
		$strDateBegin = $this->request->getVar('from').' '.$this->request->getVar('timeBegin').':00';
      	$event->dateBegin = $strDateBegin;
		$event->dateEnd = $strDateBegin;
		if($this->request->getVar('to') != null)
		{
			$strDateEnd = $this->request->getVar('to').' '.$this->request->getVar('timeEnd').':00';
			$event->dateEnd = $strDateEnd;
		}
		
		$event->description = $this->request->getVar('description');
		$event->idOrganizer = $this->request->getVar('organizer');
		$event->idPlace = $this->request->getVar('place');
		$event->idCategory = $this->request->getVar('category');
		$listPdv = $this->request->getVar('pdv_selected');

		$affichage = $this->request->getVar('affichage');
		if($affichage == 'banniere'){
			$event->affichageBan = 1;
		}
		else {
			$event->affichageBan = 0;
		}
		if($this->request->getVar('nbJsupp')!== null )
			$event->nbJourSupplementaire = $this->request->getVar('nbJsupp');
		else $event->nbJourSupplementaire = 0;

		if($this->request->getVar('dureeJourAffichage')!== null )
			$event->dureeAffichage = $this->request->getVar('dureeJourAffichage');
		else $event->dureeAffichage = 7;
			

		if (! $this->validate([
 		'nameEvent' =>'required',
 		'from' =>'required',
 		'timeBegin' => 'required',
 		'organizer' => 'required',
 		'place' =>'required',
 		'category' => 'required',
 		])){
				$organiserModel = new OrganizerModel(); 
				$data['organizerList'] = $organiserModel->organizerList();
				$priceModel = new PriceModel(); 
				$data['priceList'] = $priceModel->priceList();
				$placeModel = new PlaceModel(); 
				$data['placeList'] = $placeModel->placeList();
				$CityModel = new CityModel(); 
				$data['cityList'] = $CityModel->cityList();
				$catModel = new CategoryModel(); 
				$data['categoryList'] = $catModel->categoryList();	
				$posModel = new PointOfSaleModel(); 
				$data['pdvList'] = $posModel->pointOfSaleList();
				
				echo view('evenement_ajout',$data);
 			}
 			else if(strtotime($event->dateBegin)>strtotime($event->dateEnd)){
 				$organiserModel = new OrganizerModel(); 
				$data['organizerList'] = $organiserModel->organizerList();
				$priceModel = new PriceModel(); 
				$data['priceList'] = $priceModel->priceList();
				$placeModel = new PlaceModel(); 
				$data['placeList'] = $placeModel->placeList();
				$CityModel = new CityModel(); 
				$data['cityList'] = $CityModel->cityList();
				$catModel = new CategoryModel(); 
				
				$data['categoryList'] = $catModel->categoryList();
				$posModel = new PointOfSaleModel(); 
				$data['pdvList'] = $posModel->pointOfSaleList();
				$data['error']="la date debut doit inferieur a la date fin"; 
				
				echo view('evenement_ajout',$data);
 			}
 			
 			else{

		 		$eventModel = new EventModel(); 
				$target_dir = 'assets/img/';
				$target_file = $target_dir . basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
			}
			if ($uploadOk == 0) {
			  echo "Sorry, your file was not uploaded.";
			}
			else
			{
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
			  	{
			    	echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			  	} else
			  	{
			    	echo "Sorry, there was an error uploading your file.";
				}
				$event->image = base_url($target_file);
	        	$session = \Config\Services::session();   
				if($_SESSION['userType'] == "admin")
				{
					$event->isValidated = true;
					$event->dateDebutAffichage = date("Y-m-d");
				}
				else $event->isValidated = false;
			//var_dump($event);
				$eventModel->saveEvent($event); 
				$query = $eventModel->getLastEvent($event);
				if($query != null)
				{
							//Saving pdv

					if($listPdv != null)
					{
						$tmodel = new TicketModel();
						foreach($listPdv as $rowpdv){
						$tick = new Ticket();
						$tick->idEvent = ((object)$query)->idEvent;
						$tick->idPointOfSale = $rowpdv;
						$tmodel->save($tick);
					}

				}
				//Saving price
				if($this->request->getVar('gratuit')=="on") 
				{
					
					$aprice = new Price();
					$aprice->idEvent = ((object)$query)->idEvent;
					$aprice->name = "Gratuit";
					$aprice->value =  "0";
					$pricemod = new PriceModel();
					$pricemod->save($aprice);
							
				}
				else
				{
					echo "non gratuit"+$lstprice;
					return;
					$lstprice = $this->request->getVar('listTarif');
					if($lstprice!=null){
						$pricemod = new PriceModel();
						foreach($lstprice as $rowtrf)
						{
							$aprice = new Price();
							$aprice->idEvent = ((object)$query)->idEvent;
							$aprice->name = explode(":", $rowtrf)[0];
							$aprice->value = explode(":", $rowtrf)[1];
							$pricemod->save($aprice);
						}
					}
					else	{
						$aprice = new Price();
						$aprice->idEvent = ((object)$query)->idEvent;
						$aprice->name = "Gratuit";
						$aprice->value =  "0";
						$pricemod = new PriceModel();
						$pricemod->save($aprice);
					}
				}
			}
			return redirect()->to(base_url('event_list'));
			}
		}
	}

	public function update()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$eventModel = new EventModel(); 
			$data['event'] = (object)$eventModel->eventByIdEvent($id);
			$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
			$priceModel = new PriceModel(); 
			$data['priceList'] = $priceModel->priceList();
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$catModel = new CategoryModel(); 
			$data['categoryList'] = $catModel->categoryList();
			$posModel = new PointOfSaleModel(); 
			$trfModel = new PriceModel(); 
			$data['pdvList'] = $posModel->pointOfSaleList();
			$pdvListSelected = $posModel->pointOfSaleByIdEvent($id);
			$data['pdvListSelected'] = $posModel->pointOfSaleByIdEvent($id);
			$data['trfListSelected'] = $trfModel->priceByEvent($id);
			
			$printPriceModel = new PrintPriceModel();
	  		$data['printPrice'] = (object)$printPriceModel->priceFirst();
	  		
			echo view('evenement_ajout',$data);
		}	
		else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	

	public function updateEvent()
	{
		$id = $this->request->getVar('id');
		$eventModel = new EventModel(); 
		$e=(object)$eventModel->eventByIdEvent($id);
		$event = new Event();
		$event->dateDebutAffichage =  $e->dateDebutAffichage;
		$event->nbJourSupplementaire =  $e->nbJourSupplementaire;
		$event->affichageBan = $e->affichageBan;
		$event->dureeAffichage = $e->dureeAffichage;
		
		$event->name = $this->request->getVar('nameEvent');
		$event->description = $this->request->getVar('description');
		$event->idOrganizer = $this->request->getVar('organizer');
		$event->idPlace = $this->request->getVar('place');
		$event->idPrice = $this->request->getVar('price');
		$event->idCategory = $this->request->getVar('category');
		$event->isValidated = $this->request->getVar('isValidated');
		$event->image = $this->request->getVar('imageLastName');
		
		$listPdv = $this->request->getVar('pdv');
		$listTarif = $this->request->getVar('listTarif');
		$tmodel = new TicketModel();
		$trfmodel = new PriceModel();
		$tmodel->deletePdvByIdEvent($id);
		$listPdv = $this->request->getVar('pdv_selected');

		
		if($listPdv != null)
		{
			foreach($listPdv as $rowpdv)
			{
				$tick = new Ticket();
				$tick->idEvent = $id;
				$tick->idPointOfSale = $rowpdv;
				$tmodel->save($tick);
			}	
		}
		
		$trfmodel->deleteTrfByIdEvent($id);
		
		if($this->request->getVar('gratuit')=="on") 
		{
			$aprice = new Price();
			$aprice->idEvent = $id;
			$aprice->name = "Gratuit";
			$aprice->value =  "0";
			$pricemod = new PriceModel();
			$pricemod->save($aprice);
			
		}
		else
		{
			$lstprice = $this->request->getVar('listTarif');
			if($lstprice!=null){
				$pricemod = new PriceModel();
				foreach($lstprice as $rowtrf)
				{
					$aprice = new Price();
					$aprice->idEvent = $id;
					$aprice->name = explode(":", $rowtrf)[0];
					$aprice->value = explode(":", $rowtrf)[1];
					$pricemod->save($aprice);
				}
			}
			else	{
				$aprice = new Price();
				$aprice->idEvent = $id;
				$aprice->name = "Gratuit";
				$aprice->value =  "0";
				$pricemod = new PriceModel();
				$pricemod->save($aprice);
			}
		}
		
		$strDateBegin = $this->request->getVar('from').' '.$this->request->getVar('timeBegin').':00';
      	$event->dateBegin = $strDateBegin;
		$event->dateEnd = $strDateBegin;
		if($this->request->getVar('to') != null)
		{
			$strDateEnd = $this->request->getVar('to').' '.$this->request->getVar('timeEnd').':00';
			$event->dateEnd = $strDateEnd;
			
		}
		
		if (! $this->validate([
 			'nameEvent' =>'required',
 			'from' =>'required',
 			
 			'timeBegin' => 'required',
 			//'timeEnd' =>'required'
 			])){
			$eventModel = new EventModel(); 
			$data['event'] = (object)$eventModel->eventByIdEvent($id);
			$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$priceModel = new PriceModel(); 
			$data['priceList'] = $priceModel->priceList();
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeList();
			$catModel = new CategoryModel(); 
		
			$data['categoryList'] = $catModel->categoryList();
			$posModel = new PointOfSaleModel(); 
			$data['pdvList'] = $posModel->pointOfSaleList();

			echo view('evenement_ajout',$data);
		}
		else if (strtotime($event->dateBegin)>strtotime($event->dateEnd)) {
			$eventModel = new EventModel(); 
			$data['event'] = (object)$eventModel->eventByIdEvent($id);
			$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
			$priceModel = new PriceModel(); 
			$data['priceList'] = $priceModel->priceList();
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$catModel = new CategoryModel(); 
			
			$data['categoryList'] = $catModel->categoryList();
			$data['error']="la date debut doit inferieur a la date fin"; 
			$posModel = new PointOfSaleModel(); 
			$data['pdvList'] = $posModel->pointOfSaleList();
			echo view('evenement_ajout',$data);
		}
		
		else{
		
		$target_dir = 'assets/img/';
		//"C:/wamp64/www/event/assets/img/"
		//$target_dir = base_url('');
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		}
		else {
		  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		   // $event->image =  basename($_FILES["image"]["name"]);
            $event->image = base_url($target_file);
		  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}
	
			//todo test if upload 
		$eventModel->updateEvent($id,$event);
		return redirect()->to(base_url('event_list'));
		}
		
	}

	public function openAjoutView(){
		
	}
	public function delete(){
		$id = $_GET['id'];
		$eventModel = new EventModel(); 
		$eventModel->deleteEvent($id);
		return redirect()->to(base_url('event_list'));
	}

	public function deleteEvent(){
		$id = $_GET['id'];
		$eventModel = new EventModel(); 
		$eventModel->deleteEvent($id);
		return redirect()->to(base_url('evenement-list-refonte'));
	}
  
  	public function searchLikeByIdUser(){
      $session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$eventModel = new EventModel();
	      	$dataRes  = $eventModel->eventLikeBO($_GET['id']);
			
			
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
                        ];

               /* $price = ['idPrice'=> $row->idPrice,
                        'classic' => $row->classic,
                        'silver' => $row->silver,
                        'premium' => $row->premium,
                        ]; */

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
                $countLike=$eventModel->countLike($row->idEvent);
                foreach($countLike as $c) $nbLike = $c->nbLike;
                
				$tarifs = array();
				$priceModel = new PriceModel(); 
                $tarifList = $priceModel->priceByEvent($row->idEvent);
                if(!empty($tarifList)) {
					foreach($tarifList as $rowT){
					  	$tarf = ['idPlace'=> $rowT->idPrice,
							'valueOfPrice' => $rowT->value,
							'namePrice' => $rowT->name,
							];
						array_push($tarifs, $tarf);
					}
				}
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'organisator'  => $organizer,
                        'placeName'  => $row->placeName,
                        'nameCity'  => $row->nameCity,
                        'nameOrganizer'  => $row->nameOrganizer,
                        'nameCategory'  => $row->nameCategory,
                        'price'  => $price,
                        'placeOfSale' => $placeOfSale,
                        'nbLike' => $nbLike,
						'tarif' => $tarifs,
						'isValidated' => $row->isValidated,
						'dureeAffichage' => $row->dureeAffichage,
						'dateDebutAffichage' => $row->dateDebutAffichage,
						'dateEnd' => $row->dateEnd,
                    ]; 
                array_push($eventList, $event);
              }
          }
		  $data['events'] = $eventList;
		  echo view('evenement_liste_specifique', $data);
		 }
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}

    }
  
    public function details(){
    	$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$eventList = $this->getListEventByDetail($_GET['id'],false);
			$data['event'] = $eventList;
			$events = array_values($eventList);
			echo view('event_details', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
    }

    public function validateEvent(){
    	$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$eventModel = new EventModel();
	      	$eventModel->validateEvent($_GET['id']);
	      	$ev = (object)$eventModel->eventByIdEvent($_GET['id']);
			$eventList = $this->getListEventByDetail(0,true);
			$data['events'] = $eventList;
			$events = array_values($eventList);
			//sending push
			//var_dump('push send......',$_GET['id']);
			$this->sendNotification($_GET['id'],$ev->name,$ev->description);
			
	    	echo view('evenement_liste', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}

    }
	public function eventDeleteList()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$eventModel = new EventModel();
				
			if($_POST['listEvent'] != null){
				$li = $_POST['listEvent'];
				foreach($li as $e)
				{
					$eventModel->delete($e);
				}
				$arr = array('status' => 200,'message' =>'success','data'=> null);
					header('Content-Type:application/json');
					echo json_encode($arr);
					return;
			}
			$arr = array('status' => 200,'message' =>'success','data'=> null);
					header('Content-Type:application/json');
					echo json_encode($arr);
		}
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	}
	}
	public function eventvalidate()
	{
		
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$eventModel = new EventModel();
				
			if($_POST['listEvent'] != null){
				$li = $_POST['listEvent'];
				foreach($li as $e)
				{
					$eventModel->validateEvent($e);
					$ev = (object)$eventModel->eventByIdEvent($e);
					$this->sendNotification($e,$ev->name,$ev->description);
				}
				$arr = array('status' => 200,'message' =>'success','data'=> null);
					header('Content-Type:application/json');
					echo json_encode($arr);
					return;
			}
			else{
				if($_POST['idEv'] != null) {
					$eventModel->validateEvent($_POST['idEv']);
					$ev = (object)$eventModel->eventByIdEvent($_POST['idEv']);
					$this->sendNotification($_POST['idEv'],$ev->name,$ev->description);
				}
				$eventList = $this->getListEventByDetail(0,false);
				return redirect()->to(base_url('evenement-list-refonte'));
			}
		}
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	}
	}
	public function validateEventRefonte(){
    	$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			
			$eventModel = new EventModel();
	      	$eventModel->validateEvent($_GET['id']);
			$ev = (object)$eventModel->eventByIdEvent($_GET['id']);
			$this->sendNotification($_GET['id'],$ev->name,$ev->description);
			$eventList = $this->getListEventByDetail(0,true);
			$data['events'] = $eventList;
			$events = array_values($eventList);
			echo view('evenement_liste', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}

    }
	
	public function sendNotificationTest(){
    	// Sending push


		// API access key from Google API's Console
		define( 'API_ACCESS_KEY', 'AAAArU_CjGg:APA91bEAPcsET9NVSBr242818dnd2KA1sD3Zd-bm3J08qGzpYTHQmGtdEyu7qstvk69XYMkcLOOlKhOQNvv49RJ1YTzWJXvHjqbSdo84zWeHFQfjqNkUinTgbnZLPco0a7Vsz4NNydp3' );


		//getting list token 
		$tokenModel = new TokenModel();
		$eventModel = new EventModel();
		$listToken = $tokenModel->liste();
		$listArray = array();
		foreach ($listToken as $row) {
			array_push($listArray, $row['tokenValue']);
		}
		array_push($listArray, 'ebv9IH1USoi8o49WFPpcwF:APA91bFqUQaxnV43BFjDS-5skvWwh_DSX4I-4XjzMGgTXBFIoUi-JDJfDMdsOrn0JS-q2Zao_9TZtagrHimyKGGp2Yy7A8KheIzzQLFQGnqDbHmYnnwFC6uC4hb4cWBB3dGG9yx2i_FQ');

		
		//$registrationIds = array($listArray);
		
		//$registrationIds = array('ebv9IH1USoi8o49WFPpcwF:APA91bFqUQaxnV43BFjDS-5skvWwh_DSX4I-4XjzMGgTXBFIoUi-JDJfDMdsOrn0JS-q2Zao_9TZtagrHimyKGGp2Yy7A8KheIzzQLFQGnqDbHmYnnwFC6uC4hb4cWBB3dGG9yx2i_FQ');

		// prep the bundle
		$idNewEvent = 0;
		
		$msg = array
		(
			'message' 	=> 'here is a message. message',
			'title'		=> 'This is a title. title',
			'subtitle'	=> 'This is a subtitle. subtitle',
			'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
			'vibrate'	=> 1,
			'sound'		=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> 'small_icon',
			'idEvent' => $idNewEvent,
		);

		$fields = array
		(
			'registration_ids' 	=> $listArray,
			'data'			=> $msg
		);
		 
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		 
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		//echo "test push ".$result;

		//end sending push
		var_dump('push send......',$listToken);
    }
	
	public function sendNotification($idEvent,$title,$description){
		// API access key from Google API's Console
		define( 'API_ACCESS_KEY', 'AAAArU_CjGg:APA91bEAPcsET9NVSBr242818dnd2KA1sD3Zd-bm3J08qGzpYTHQmGtdEyu7qstvk69XYMkcLOOlKhOQNvv49RJ1YTzWJXvHjqbSdo84zWeHFQfjqNkUinTgbnZLPco0a7Vsz4NNydp3' );
		//getting list token 
		$tokenModel = new TokenModel();
		$eventModel = new EventModel();
		$listToken = $tokenModel->liste();
		$listArray = array();
		foreach ($listToken as $row) {
			array_push($listArray, $row['tokenValue']);
		}
		array_push($listArray, 'ebv9IH1USoi8o49WFPpcwF:APA91bFqUQaxnV43BFjDS-5skvWwh_DSX4I-4XjzMGgTXBFIoUi-JDJfDMdsOrn0JS-q2Zao_9TZtagrHimyKGGp2Yy7A8KheIzzQLFQGnqDbHmYnnwFC6uC4hb4cWBB3dGG9yx2i_FQ');
		// prep the bundle
		
		$msg = array
		(
			'message' 	=> $description,
			'subtitle'	=> 'This is a subtitle. subtitle',
			'vibrate'	=> 1,
			'sound'		=> 1,
			'largeIcon'	=> 'large_icon',
			'smallIcon'	=> 'small_icon',
			'idEvent' => $idEvent,
			'title'		=> $title,
		);

		$fields = array
		(
			'registration_ids' 	=> $listArray,
			'data'			=> $msg
		);
		 
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		 
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		echo "test push ".$result;

		//end sending push
		 return;
		
    }
			
  	public function boindex(){
		  echo view('welcome_message');
	  }	
  	public function pageAjoutEvenement()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
		  	$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
			$priceModel = new PriceModel(); 
			$data['priceList'] = $priceModel->priceList();
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeListWithCity();
			$catModel = new CategoryModel(); 
			$data['categoryList'] = $catModel->categoryList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$PointOfSaleModel = new PointOfSaleModel(); 
			$data['pdvList'] = $PointOfSaleModel->pointOfSaleList();
			
			$printPriceModel = new PrintPriceModel();
	  		$data['printPrice'] = (object)$printPriceModel->priceFirst();
	  		$data= $this->getDataMenu($data);
			
			  echo view('evenement_ajout_refonte',$data);

		}
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	 }
	}
	public function pageUpdateEvent()
	{
		$data = null;
		$this->beforeAjoutEvent($data);
		echo view('evenement_ajout_refonte');
	}
	public function searchEventLikedByIdUser()
	{
		$session = \Config\Services::session(); 		
		if(isset($_SESSION['userSession']) == TRUE){
		  $eventList = array();
		  $eventModel = new EventModel();
			$dataRes  = $eventModel->eventLikeBO($_GET['id']);
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
                        ];

               /* $price = ['idPrice'=> $row->idPrice,
                        'classic' => $row->classic,
                        'silver' => $row->silver,
                        'premium' => $row->premium,
                        ]; */

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
                $countLike=$eventModel->countLike($row->idEvent);
                foreach($countLike as $c) $nbLike = $c->nbLike;
                
				$tarifs = array();
				$priceModel = new PriceModel(); 
                $tarifList = $priceModel->priceByEvent($row->idEvent);
                if(!empty($tarifList)) {
					foreach($tarifList as $rowT){
					  	$tarf = ['idPlace'=> $rowT->idPrice,
							'valueOfPrice' => $rowT->value,
							'namePrice' => $rowT->name,
							];
						array_push($tarifs, $tarf);
					}
				}
                $event = ['idEvent'=> $anEvent->idEvent,
                        'name' => $anEvent->name,
                        'dateBegin' => $anEvent->dateBegin,
                        'dateEnd' => $anEvent->dateEnd,
                        'idCategory' => $anEvent->idCategory,
                        'image' => $anEvent->image,
                        'description' => $anEvent->description,
                        'organisator'  => $organizer,
                        'placeName'  => $row->placeName,
                        'nameCity'  => $row->nameCity,
                        'nameOrganizer'  => $row->nameOrganizer,
                        'nameCategory'  => $row->nameCategory,
                        'price'  => $price,
                        'placeOfSale' => $placeOfSale,
                        'nbLike' => $nbLike,
						'tarif' => $tarifs,
						'isValidated' => $row->isValidated,
						'dureeAffichage' => $row->dureeAffichage,
						'dateDebutAffichage' => $row->dateDebutAffichage,
						'dateEnd' => $row->dateEnd,
                    ]; 
                array_push($eventList, $event);
              }
          }
		  $data['events'] = $eventList;
			
			echo view('evenement_liste_refonte_search', $data);
	   }
		else{
			return redirect()->to(base_url('connexion'));
		}
	}
	public function pageInfoEvent()
	{
		$session = \Config\Services::session(); 
		$eventModel = new EventModel();	
		$posModel = new PointOfSaleModel();	
		$priceModel = new PriceModel();	
		// ie = av == est a valider
		if($_GET['iE'] == "av"){
			if($_SESSION["userType"] == "admin"){
				$data['av'] = "display:none;";
				$qu = $eventModel->getEventToValidate();
				$data['statut'] = "en attente de validation";
				$data['textButton'] = '<input type="hidden" name="idEv" value="<?php echo $idEvent;?>">
                  <div class="col-lg-4" style="float:right">
                 <input type="submit" id="" name="buttonSubmit"  class="btn vert-button"  style="width:100%;background-color:#4ECDC4;color:white" value="Valider et publier"/>
                 </div>
                 <div class="col-lg-4" style="float:right">
                 <input type="button" id="" onclick="rejeter('.$idEvent.')" class="btn vert-button"  style="width:100%" value="Rejeter"/>
                 </div>';
				 
				 //init pagination
				 $index = $_GET['currentIndex'];
				if($index === null){
					$index = 0;
				}
				 //$data['currentEvent'] =$qu[$index];
				 $idEvent = $qu[$index]->idEvent; 
				if($index+1<count($qu))
				{
					$data['hasNext'] =true;
				}
				if($index>0)
				{
					$data['hasPrevious'] =true;
				}
				$data['currentIndex'] =$index;
				
			}
			else{
				$qu = $eventModel->getEventToValidateByIdOrg($_SESSION['idOrganizer']);
				//init pagination
				 $index = $_GET['currentIndex'];
				if($index === null){
					$index = 0;
				}
				 //$data['currentEvent'] =$qu[$index];
				 $idEvent = $qu[$index]->idEvent; 
				if($index+1<count($qu))
				{
					$data['hasNext'] =true;
				}
				if($index>0)
				{
					$data['hasPrevious'] =true;
				}
				$data['currentIndex'] =$index;
				$data['textButton'] = '<input type="hidden" name="idEvent" value="'.$idEvent.'">
                 <div class="col-lg-4" style="float:right">
                 <input type="button"  onclick="deleteEvent('.$idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
                 </div>';
				 $data['statut'] = "en attente de validation";
				 $data['av'] = "display:block;";
				
			}
			
			$data['toUpdate'] = 1;
			$data['ev'] = $eventModel->eventById($idEvent);
			$data['tarif'] = $priceModel->priceByEvent($idEvent);
			$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
			$cmodel = new CommentEventModel();
			$data['listComms'] = $cmodel->listComments($idEvent);
			if(!empty($data['listComms'])) $data['av'] = "display:block;";
			$data= $this->getDataMenu($data);
			echo view('evenement_info',$data);
			return;
		}
		else if(isset($_GET['iU']) && !empty($_GET['iU']))
		{
			$idEvent = $_GET['iU']; 
				$id = $_GET['iU'];
				$eve = $eventModel->eventById($_GET['iU']);
				$data['event'] = (object)$eve;
				
				//Check status 
				foreach($eve as $event){
					//$dateB = $event->dateFinAffichage;
					$h = "3";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
					$hm = $h * 60;
					$ms = $hm * 60;
					$dateAuj = gmdate("Y-m-d H:i:s",time()+($ms));
					//aucune action a part supprimer 
					if($event->isValidated == 1)
					{
						if(new DateTime($dateAuj) < new DateTime(explode(' ',$event->dateDebutAffichage)[0]))
						   $statut = 'En attente de publication';
						   else $statut = 'Publi&eacute;';
					}
					if($event->isValidated == 0) $statut = 'En attente de validation';
					if($event->isValidated == 3) $statut = 'Brouillon';
					if($event->isValidated == 4) $statut = 'Rejet&eacute;';
					
					$dateB = date_create(explode(' ',$event->dateDebutAffichage)[0]);
					date_add($dateB, date_interval_create_from_date_string($event->dureeAffichage.' days 23 hours 59 minutes'));
					
					$event->dateFinAffichage = date_format($dateB,"Y-m-d");
					$data['statut'] = $statut;
					if($statut == 'Brouillon'){
						//Envoyer brouillon ou envoyer pour validation
						$data['buttonText']  = '<div class="col-lg-4" style="margin-bottom:15px !important">
					 <input type="submit" name="buttonSubmit"  class="btn vert-button"  style="width:100%" value="Enregistrer en brouillon"/>
					 </div>
					 <div class="col-lg-4"  style="margin-bottom:15px !important">
					 <input type="submit" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Envoyer pour validation"/>
					 </div>';
					}
					else if($statut=='Rejet&eacute;')
					{
						//Envoyer pour validation
						$data['buttonText']  = '<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="button" onclick="deleteEvent('.$idEvent.')" class="btn vert-button"  style="width:100%" value="Supprimer"/>
						</div>
						<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="submit" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Envoyer pour validation"/>
						</div>';
					}
					else{
						//mettre a jour ou supprimer
						$data['buttonText']  = '<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="button" onclick="deleteEvent('.$idEvent.')" class="btn vert-button"  style="width:100%" value="Supprimer"/>
						</div>
						<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="submit" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Mettre &agrave; jour"/>
						</div>';
					}
					
					$data['toUpdate'] = true;
					$data['pdvList'] = $posModel->pointOfSaleList();
					$data['pdvListSelected'] = $posModel->pointOfSaleByIdEvent($id);
					$priceEventList = $priceModel->priceByEvent($id);
					$data['trfListSelected'] = $priceEventList;
					
					foreach($priceEventList as $rowPrice){
						if($rowPrice->name =="Gratuit"  || $rowPrice->value == 0){
							$data['isEventGratuit'] = 1;
						}
					}
					$cmodel = new CommentEventModel();
					$data['listComms'] = $cmodel->listComments($id);
					$this->beforeAjoutEvent($data);
					return;
				}
		}
		else{
			$data['av'] = "display:none;";
				
			if($_SESSION["userType"] == "admin"){
				$idEvent = $_GET['iE']; 
				$data['toUpdate'] = 1;
				$e = $eventModel->eventById($idEvent);
				//var_dump($e); return;
				$data['ev'] = $e;
				$data['asupp'] = 1;
				foreach($e as $eve){
					$data['textButton'] = '<input type="hidden" name="idEvent" value="'.$eve->idEvent.'">
						 <div class="col-lg-4" style="float:right">
						 <input type="button" onclick="deleteEvent('.$eve->idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
						 </div>';
					$h = "3";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
					$hm = $h * 60;
					$ms = $hm * 60;
					$dateAuj = gmdate("Y-m-d H:i:s",time()+($ms));
					//aucune action a part supprimer 
					if($eve->isValidated == 1)
					{
						if(new DateTime($dateAuj) < new DateTime(explode(' ',$eve->dateDebutAffichage)[0]))
						   	$data['statut']  = 'En attente de publication';
						   else $data['statut']  = 'Publi&eacute;';
					}
					if($eve->isValidated == 3) $data['statut']= "Brouillon";
					if($eve->isValidated == 4) {
					$data['statut']= "Rejet&eacute;";
					$data['av']='display:block';
					}
					$dateB = date_create(explode(' ',$eve->dateDebutAffichage)[0]);
					date_add($dateB, date_interval_create_from_date_string($eve->dureeAffichage.' days 23 hours 59 minutes'));
					$eve->dateFinAffichage = date_format($dateB,"Y-m-d");
					if($eve->isValidated == 0 ) 
					{
						$data['statut']="en attente de validation";
						$data['textButton'] = '<input type="hidden" name="idEv" value="<?php echo $idEvent;?>">
						  <div class="col-lg-4" style="float:right">
						 <input type="submit" id="" name="buttonSubmit"  class="btn vert-button"  style="width:100%;background-color:#4ECDC4;color:white" value="Valider et publier"/>
						 </div>
						 <div class="col-lg-4" style="float:right">
						 <input type="button" id="" onclick="rejeter('.$eve->idEvent.')" class="btn vert-button"  style="width:100%" value="Rejeter"/>
						 </div>';
					}
					if(new Time(date("Y-m-d H:i:s")) >  $dateB)
					{
							$data['textButton'] = '<input type="hidden" name="idEvent" value="'.$eve->idEvent.'">
							 <div class="col-lg-4" style="float:right">
							 <input type="button" onclick="deleteEvent('.$eve->idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
							 </div>';
							 $data['statut']="Non publi&eacute;";
							 $data['tarif'] = $priceModel->priceByEvent($idEvent);
							$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
							$cmodel = new CommentEventModel();
							$data['listComms'] = $cmodel->listComments($idEvent);
							$data= $this->getDataMenu($data);
							echo view('evenement_info',$data);
							return;
					}
					if(new Time(date("Y-m-d")) > new Time(explode(' ',$eve->dateEnd)[0])){
								$data['avalider'] = 1;
								$data['textButton'] = '<input type="hidden" name="idEvent" value="'.$eve->idEvent.'">
								 <div class="col-lg-4" style="float:right">
								 <input type="button" onclick="deleteEvent('.$eve->idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
								 </div>';
								 $data['statut']="Pass&eacute;";
								 $data['tarif'] = $priceModel->priceByEvent($idEvent);
								$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
								$cmodel = new CommentEventModel();
								$data['listComms'] = $cmodel->listComments($idEvent);
								$data= $this->getDataMenu($data);
								echo view('evenement_info',$data);
								return;
					}
					
				
				}
				
				$data['tarif'] = $priceModel->priceByEvent($idEvent);
				$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
				$cmodel = new CommentEventModel();
				$data['listComms'] = $cmodel->listComments($idEvent);
				$data= $this->getDataMenu($data);
				echo view('evenement_info',$data);
				return;
			}
			else
			{
				$idEvent = $_GET['iE']; 
				$id = $_GET['iE'];
				$eve = $eventModel->eventById($_GET['iE']);
				$data['event'] = (object)$eve;
				//Check status 
				foreach($eve as $event){
					//$dateB = $event->dateFinAffichage;
					$h = "3";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
					$hm = $h * 60;
					$ms = $hm * 60;
					$dateAuj = gmdate("Y-m-d H:i:s",time()+($ms));
					
					//aucune action a part supprimer 
					if($event->isValidated == 1) 
					{
						if(new DateTime($dateAuj) < new DateTime(explode(' ',$event->dateDebutAffichage)[0]))
						   	$statut = 'En attente de publication';
						   else $statut = 'Publi&eacute;';
						
						
					}
					if($event->isValidated == 0) $statut = 'En attente de validation';
					if($event->isValidated == 3) $statut = 'Brouillon';
					if($event->isValidated == 4) $statut = 'Rejet&eacute;';
					$dateB = date_create(explode(' ',$event->dateDebutAffichage)[0]);
					date_add($dateB, date_interval_create_from_date_string($event->dureeAffichage.' days 23 hours 59 minutes'));
					$event->dateFinAffichage = date_format($dateB,"Y-m-d H:i");
					
					$data['statut'] = $statut;
					if($statut == 'Brouillon'){
						//Envoyer brouillon ou envoyer pour validation
						$data['buttonText']  = '<div class="col-lg-4"  style="margin-bottom:15px !important">
					 <input type="submit" name="buttonSubmit"  class="btn vert-button"  style="width:100%" value="Enregistrer en brouillon"/>
					 </div>
					 <div class="col-lg-4"  style="margin-bottom:15px !important">
					 <input type="submit" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Envoyer pour validation"/>
					 </div>';
					}
					else if($statut=='Rejet&eacute;')
					{
						//Envoyer pour validation9
						$data['buttonText']  = '<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="button" onclick="deleteEvent('.$idEvent.')" class="btn vert-button"  style="width:100%" value="Supprimer"/>
						</div>
						<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="submit" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Envoyer pour validation"/>
						</div>';
					}
					else{
						//mettre a jour ou supprimer
						$data['buttonText']  = '<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="button" onclick="deleteEvent('.$idEvent.')" class="btn vert-button"  style="width:100%" value="Supprimer"/>
						</div>
						<div class="col-lg-4"  style="margin-bottom:15px !important">
						<input type="submit" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Mettre &agrave; jour"/>
						</div>';
					}
					if(new Time(date("Y-m-d H:i:s")) >  new Time(explode(' ',$event->dateEnd)[0]) )
					{
					  $data['statut'] = 'Pass&eacute;';
					  $data['textButton'] = '<input type="hidden" name="idEvent" value="'.$event->idEvent.'">
							 <div class="col-lg-4" style="float:right">
							 <input type="button" onclick="deleteEvent('.$event->idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
							 </div>';
							 $data['toUpdate'] = 1;
							$data['asupp'] = 1;
							$data['ev'] = $eve;
							$data['tarif'] = $priceModel->priceByEvent($idEvent);
							$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
							$cmodel = new CommentEventModel();
							$data['listComms'] = $cmodel->listComments($idEvent);
							$data= $this->getDataMenu($data);
							echo view('evenement_info',$data);
							return;
					}
					if(new Time(date("Y-m-d H:i:s")) > $dateB){
						$data['statut'] = 'Non publi&eacute;';
						$data['textButton'] = '<input type="hidden" name="idEvent" value="'.$event->idEvent.'">
							 <div class="col-lg-4" style="float:right">
							 <input type="button" onclick="deleteEvent('.$event->idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
							 </div>';
							 $data['toUpdate'] = 1;
						$data['asupp'] = 1;
						$data['ev'] = $eve;
						$data['tarif'] = $priceModel->priceByEvent($idEvent);
						$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
						$cmodel = new CommentEventModel();
						$data['listComms'] = $cmodel->listComments($idEvent);
						$data= $this->getDataMenu($data);
						echo view('evenement_info',$data);
						return;
					}
					
					$data['toUpdate'] = true;
					$data['pdvList'] = $posModel->pointOfSaleList();
					$data['pdvListSelected'] = $posModel->pointOfSaleByIdEvent($id);
					$priceEventList = $priceModel->priceByEvent($id);
					$data['trfListSelected'] = $priceEventList;
					
					foreach($priceEventList as $rowPrice){
						if($rowPrice->name =="Gratuit"  || $rowPrice->value == 0){
							$data['isEventGratuit'] = 1;
						}
					}
					/*if($data['statut'] == 'Rejet&eacute;' || $data['statut'] == 'Publi&eacute;')
					{
						$this->goPageInfo($idEvent);
						return;
					 }*/
					 
					 $cmodel = new CommentEventModel();
							$data['listComms'] = $cmodel->listComments($id);
					$this->beforeAjoutEvent($data);
					return;
				}
			}
		}
		return redirect()->to(base_url('connexion'));
	}
	public function goPageInfo($idEvent)
	{
		$session = \Config\Services::session(); 
		$eventModel	= new EventModel();
		$posModel = new PointOfSaleModel();	
		$priceModel = new PriceModel();	
	  	$data['info'] = true;
			$data['textButton'] = '<input type="hidden" name="idEvent" value="'.$idEvent.'">
			 <div class="col-lg-4" style="float:right">
			 <input type="button" onclick="deleteEvent('.$idEvent.')" class="btn"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Supprimer"/>
			 </div>';
			 $data['statut'] = "en attente de validation";
			 $data['av'] = "display:block;";
		$data['toUpdate'] = 1;
		$data['ev'] = $eventModel->eventById($idEvent);
		
		$data['tarif'] = $priceModel->priceByEvent($idEvent);
		$data['pos'] = $posModel->pointOfSaleByIdEvent($idEvent);
		$cmodel = new CommentEventModel();
		$data['listComms'] = $cmodel->listComments($idEvent);
		$data= $this->getDataMenu($data);
		$data['modifier'] = '<div class="col-lg-4"><input type="button" onclick="infoEvent('.$idEvent.')" name="buttonSubmit"  class="btn vert-button"  style="color:white;background-color:#4ECDC4 !important;color:white;width:100%" value="Mettre &agrave; jour"/></div>';
		echo view('evenement_info',$data);
		return;
	}
	public function beforeAjoutEvent($data)
	{
		$organiserModel = new OrganizerModel(); 
			$data['organizerList'] = $organiserModel->organizerList();
			$priceModel = new PriceModel(); 
			$data['priceList'] = $priceModel->priceList();
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeListWithCity();
			$catModel = new CategoryModel(); 
			$data['categoryList'] = $catModel->categoryList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$PointOfSaleModel = new PointOfSaleModel(); 
			$data['pdvList'] = $PointOfSaleModel->pointOfSaleList();
			$printPriceModel = new PrintPriceModel();
			$data['printPrice'] = (object)$printPriceModel->priceFirst();
			$data= $this->getDataMenu($data);
			/*echo "ito ilay data---------------:";
			var_dump($data);
				return;*/
			echo view('evenement_ajout_refonte',$data);
	}
	public function getDataMenu($data)
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			if($_SESSION['userType'] == "admin")
			{
				$data['nocolumnValidate'] = 1;
				$eventModel = new EventModel(); 
				$data['listEventsToValidate'] = $eventModel->getEventToValidate();
				$data['listEventsNotPublished'] = $eventModel->getEventNotPublished();
				$data['listEventsRejected'] = $eventModel->getEventRejected();
				$data['events'] = $eventModel->getEventPublished();
				return $data;
			}
			else
			{
				$eventList = $this->getListEventByDetail(0,false);
				$data['events'] = $eventList;
				$events = array_values($eventList);
				$eventModel = new EventModel(); 
				$data['listEventsToValidate'] = $eventModel->getEventToValidateByIdOrg($_SESSION['idOrganizer']);
				$data['listEventsNotPublished'] = $eventModel->getEventNotPublishedByIdOrg($_SESSION['idOrganizer']);
				$data['listEventsRejected'] = $eventModel->getEventRejectedByIdOrg($_SESSION['idOrganizer']);
				$data['events'] = $eventModel->getEventPublishedByIdOrg($_SESSION['idOrganizer']);
				return $data;
				
			}
		}
		else return redirect()->to(base_url('connexion'));
	}
	public function getDataMenuCook($data)
	{
			if($_COOKIES['userType'] == "admin")
			{
				$data['nocolumnValidate'] = 1;
				$eventModel = new EventModel(); 
				$data['listEventsToValidate'] = $eventModel->getEventToValidate();
				$data['listEventsNotPublished'] = $eventModel->getEventNotPublished();
				$data['listEventsRejected'] = $eventModel->getEventRejected();
				$data['events'] = $eventModel->getEventPublished();
				return $data;
			}
			else
			{
				$eventList = $this->getListEventByDetail(0,false);
				$data['events'] = $eventList;
				$events = array_values($eventList);
				$eventModel = new EventModel(); 
				$data['listEventsToValidate'] = $eventModel->getEventToValidateByIdOrg($_SESSION['idOrganizer']);
				$data['listEventsNotPublished'] = $eventModel->getEventNotPublishedByIdOrg($_SESSION['idOrganizer']);
				$data['listEventsRejected'] = $eventModel->getEventRejectedByIdOrg($_SESSION['idOrganizer']);
				$data['events'] = $eventModel->getEventPublishedByIdOrg($_SESSION['idOrganizer']);
				return $data;
				
			}
	}
	public function listRejected()
	{
			$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(-5000,false);
			$data['event'] = $eventList;
			if($_SESSION['userType']=="admin") $data['nocolumnValidate'] = 1;
			$events = array_values($eventList);
			$eventModel = new EventModel(); 
			$data = $this->getDataMenu($data);
			$pointOfSaleModel = new PointOfSaleModel(); 
			$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
			$data['pointOfSaleList'] = $pointOfSaleList;
			
			echo view('evenement_liste_refonte', $data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	 }
	}
	public function listPublished()
	{
			$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(-3000,false);
			$data['event'] = $eventList;
			if($_SESSION['userType']=="admin") $data['nocolumnValidate'] = 1;
			$events = array_values($eventList);
			$eventModel = new EventModel(); 
			$data = $this->getDataMenu($data);
			$pointOfSaleModel = new PointOfSaleModel(); 
			$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
			$data['pointOfSaleList'] = $pointOfSaleList;
			
			echo view('evenement_liste_refonte', $data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	 }
	}
	public function listNotPublished()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$eventList = $this->getListEventByDetail(-4000,false);
			$data['event'] = $eventList;
			if($_SESSION['userType']=="admin") $data['nocolumnValidate'] = 1;
			$events = array_values($eventList);
			$eventModel = new EventModel(); 
			$data = $this->getDataMenu($data);
			$pointOfSaleModel = new PointOfSaleModel(); 
			$pointOfSaleList = $pointOfSaleModel->pointOfSaleList();
			$data['pointOfSaleList'] = $pointOfSaleList;
			
			echo view('evenement_liste_refonte', $data);
	  	 }
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	 }
	}
	public function checkIfExistTopEventInCity()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		if(isset($_POST['idPlace'])){
				$eventModel = new EventModel(); 
				$res = 0;
				$datas =  $eventModel->checkIfExistTopEventInCity($_POST['idPlace']);
				foreach($datas as $row){
					$dateAuj = gmdate("Y-m-d H:i:s",time()+($ms));
					if(new DateTime($dateAuj) <= new DateTime($row->finAffichage) && new DateTime($dateAuj) <= new DateTime($row->dateEnd))
					{
						if($row->idEvent !=null)$res = 1;
					}
				}
				$data['existTop'] = $res;
				$data['event'] = $row->idEvent;
				$arr = array('status' => 200,'message' =>'succes','data'=> $data);
				header('Content-Type:application/json');
				echo json_encode($data);
				
			}
			else{
				$arr = array('status' => 200,'message' =>'identifiant du lieu a renseigner ','data'=> null);
				header('Content-Type:application/json');
				echo json_encode($arr);
			}
			
	  	 }
	  	else{
	  		$arr = array('status' => 200,'message' =>'session inexistante','data'=> null);
			header('Content-Type:application/json');
			echo json_encode($arr);
	  	 }
	}
	public function getEventByCatLp()
	{
		$idcat = $_POST['idCategory'];
		$eModel = new EventModel();
		$query = $eModel->getEventByCatLp($idcat);
		
		
		$result = array();
		if(!empty($query))
		{
			foreach($query as $c)
			{
				$res = $eModel->getMinPrice($c->idEvent);
				if($res !=null)
				{
					foreach($res as $q){
						$price = number_format($q->value, 0, ',', ' ');
					}	
					if($price == 0) $price = "Entrée gratuite";
					else $price = "A partir de ".$price." Ar";
				}
				else $price = null;
				$r['price'] = $price;
				$r['name'] = $c->name;
				$r['placeName'] = $c->placeName;
				$r['nameCity'] = $c->nameCity;
				$r['image'] = $c->image;
			 $dateToformatBegin = explode(' ',$c->dateBegin)[0];
				 $dateToformatEnd = explode(' ',$c->dateEnd)[0];
				$dateformatedBegin = explode('-',$dateToformatBegin);
				$dateformatedEnd = explode('-',$dateToformatEnd);
				$datebeginning = $dateformatedBegin[2].'/'.$dateformatedBegin[1].'/'.$dateformatedBegin[0];
				$dateending = $dateformatedEnd[2].'/'.$dateformatedEnd[1].'/'.$dateformatedEnd[0];
				$heurebeginning = explode(':',explode(' ',$c->dateBegin)[1])[0].':'.explode(':',explode(' ',$c->dateBegin)[1])[1];
				$heureending = explode(':',explode(' ',$c->dateEnd)[1])[0].':'.explode(':',explode(' ',$c->dateEnd)[1])[1];
				$dateBE = $datebeginning;
				//if($datebeginning ==  $dateending){
					$dateBE = $dateBE .' à '.$heurebeginning; 
				/* }
				 else{
					$dateBE =  $dateBE  .' de '.$heurebeginning.' au '.$dateending.' '.$heureending .' '; 
				 }*/
				$r['dateBegin'] = $dateBE;
				array_push($result,$r);
			}
			$resul = $eModel->getEventByCatLpLimit($idcat,2);
			foreach($resul as $cresul)
			{
				$resu = $eModel->getMinPrice($cresul->idEvent);
				if($resu !=null)
				{
					foreach($resu as $q){
						$price = number_format($q->value, 0, ',', ' ');
					}	
					if($price == 0) $price = "Entrée gratuite";
					else $price = "A partir de ".$price." Ar";
				}
				else $price = null;
				$rc['price'] = $price;
				$rc['name'] = $cresul->name;
				$rc['placeName'] = $cresul->placeName;
				$rc['nameCity'] = $cresul->nameCity;
				$rc['image'] = $cresul->image;
				 $dateToformatBegin = explode(' ',$cresul->dateBegin)[0];
				 $dateToformatEnd = explode(' ',$cresul->dateEnd)[0];
				$dateformatedBegin = explode('-',$dateToformatBegin);
				$dateformatedEnd = explode('-',$dateToformatEnd);
				$datebeginning = $dateformatedBegin[2].'/'.$dateformatedBegin[1].'/'.$dateformatedBegin[0];
				$dateending = $dateformatedEnd[2].'/'.$dateformatedEnd[1].'/'.$dateformatedEnd[0];
				$heurebeginning = explode(':',explode(' ',$cresul->dateBegin)[1])[0].':'.explode(':',explode(' ',$cresul->dateBegin)[1])[1];
				$heureending = explode(':',explode(' ',$cresul->dateEnd)[1])[0].':'.explode(':',explode(' ',$cresul->dateEnd)[1])[1];
				$dateBE = $datebeginning;
				$dateBE = $dateBE .' à '.$heurebeginning; 
				$rc['dateBegin'] = $dateBE;
				array_push($result,$rc);
			}
		}else
		{
			$resul = $eModel->getEventByCatLpLimit($idcat,3);
			foreach($resul as $cresul)
			{
				$resu = $eModel->getMinPrice($cresul->idEvent);
				if($resu !=null)
				{
					foreach($resu as $q){
						$price = number_format($q->value, 0, ',', ' ');
					}	
					if($price == 0) $price = "Entrée gratuite";
					else $price = "A partir de ".$price." Ar";
				}
				else $price = null;
				$rc['price'] = $price;
				$rc['name'] = $cresul->name;
				$rc['placeName'] = $cresul->placeName;
				$rc['nameCity'] = $cresul->nameCity;
				$rc['image'] = $cresul->image;
				 $dateToformatBegin = explode(' ',$cresul->dateBegin)[0];
				 $dateToformatEnd = explode(' ',$cresul->dateEnd)[0];
				$dateformatedBegin = explode('-',$dateToformatBegin);
				$dateformatedEnd = explode('-',$dateToformatEnd);
				$datebeginning = $dateformatedBegin[2].'/'.$dateformatedBegin[1].'/'.$dateformatedBegin[0];
				$dateending = $dateformatedEnd[2].'/'.$dateformatedEnd[1].'/'.$dateformatedEnd[0];
				$heurebeginning = explode(':',explode(' ',$cresul->dateBegin)[1])[0].':'.explode(':',explode(' ',$cresul->dateBegin)[1])[1];
				$heureending = explode(':',explode(' ',$cresul->dateEnd)[1])[0].':'.explode(':',explode(' ',$cresul->dateEnd)[1])[1];
				$dateBE = $datebeginning;
				$dateBE = $dateBE .' à '.$heurebeginning; 
				$rc['dateBegin'] = $dateBE;
				array_push($result,$rc);
			}
		}
		
		$arr = array('status' => 200,'message' =>'succes ','data'=> $result);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function getMinPrice()
	{
		$idE = $_POST['idEvent'];
		$eModel = new EventModel();
		$query = $eModel->getMinPrice($idE);
		if($query !=null)
		{
			foreach($query as $q){
				$price = $q->value;
			}
			$arr = array('status' => 200,'message' =>'succes ','data'=> $price);
			header('Content-Type:application/json');
			echo json_encode($arr);
		}
		else{
			$arr = array('status' => 200,'message' =>'succes ','data'=> null);
			header('Content-Type:application/json');
			echo json_encode($arr);
		}
	}
	public function formatagePrix($prix)
	{
		
	}
}