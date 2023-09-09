<?php namespace App\Controllers;
use App\Models\OrganizerModel;
use App\Models\EventModel;
use App\Entities\Organizer;
use App\Entities\User;
use App\Models\UserModel;
use App\Controllers\EventController;

class OrganizerController extends BaseController
{
	public function index() { 
     //  $this->organizerList();	
    } 
  
	public function searchOrganizer()
	{
		
		$organizerModel = new OrganizerModel(); 
		
		$textToFind = $this->request->getVar('textToFind');
		
		$data=$organizerModel->searchOrganizer($textToFind);
		
		echo json_encode($data);
	}

    public function ajout()
	{
		echo view('organisateur_ajout');
	}
	public function suivi()
	{
		echo view('organisateur_suivi');
	}

	public function listeRefonte()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$organizerModel = new OrganizerModel(); 
			$eventModel = new EventModel();
			$listOrg = $organizerModel->organizerList();
			$listOrgToView =  array();
			foreach ($listOrg as $org) {
				$unorg = new Organizer();
				$unorg->idOrganizer = $org->idOrganizer;
				$unorg->name = $org->name;
				$unorg->description = $org->description;
				$unorg->phone = $org->phone;
				$unorg->email = $org->email;
				$unorg->idOrganizer = $org->idOrganizer;
				$countFollow=$organizerModel->countFollow($unorg->idOrganizer);
	            foreach($countFollow as $c) $unorg->nbFollow = $c->nbFollow;
				$nEvt =  array();
				$nEvt = $eventModel->countEventSearchByOrganizer($unorg->idOrganizer);
				foreach ($nEvt as $e) {
					$unorg->nbEvents = $e->nbEvents;
				}
				array_push($listOrgToView,$unorg);
			}
			$data['listEventsToValidate'] = $eventModel->getEventToValidate();
			$data['listEventsNotPublished'] = $eventModel->getEventNotPublished();
			$data['OrganizerList'] = $listOrgToView;
			$uCtrl = new EventController();
			$data = $uCtrl->getDataMenu($data);
			echo view('organisateur_liste_refonte', $data);
		}
	}
    public function liste()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
	  		$organizerModel = new OrganizerModel(); 
			$eventModel = new EventModel();
			$listOrg = $organizerModel->organizerList();
			$listOrgToView =  array();
			foreach ($listOrg as $org) {
				$unorg = new Organizer();
				$unorg->idOrganizer = $org['idOrganizer'];
				$unorg->name = $org['name'];
				$unorg->description = $org['description'];
				$unorg->phone = $org['phone'];
				$unorg->email = $org['email'];
				$unorg->idOrganizer = $org['idOrganizer'];
				$countFollow=$organizerModel->countFollow($unorg->idOrganizer);
	            foreach($countFollow as $c) $unorg->nbFollow = $c->nbFollow;
				$nEvt =  array();
				$nEvt = $eventModel->countEventSearchByOrganizer($unorg->idOrganizer);
				foreach ($nEvt as $e) {
					$unorg->nbEvents = $e->nbEvents;
				}
				array_push($listOrgToView,$unorg);
			}
			$data['OrganizerList'] = $listOrgToView;
			echo view('organisateur_liste', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }	
	}
	public function organizerById()
	{
		$organizerModel = new OrganizerModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data['organizerById'] = $organizerModel->organizerById($idOrganizer);
		echo view('organisateur_liste', $data);
	}
	public function organizerDetails()
	{
		$organizerModel = new OrganizerModel();
		$eventModel = new EventModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data['organizerDetails'] = $organizerModel->organizerById($idOrganizer);
		$data['organizerEvents'] = $eventModel->eventSearchByOrganizer($idOrganizer);
		echo view('organisateur_liste', $data);
	}
	public function organizerFollow()
	{
		$organizerModel = new OrganizerModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$organizerModel->organizerFollow($idOrganizer);
	}
	public function deleteOrganizer()
	{
		$organizerModel = new OrganizerModel(); 
		$uModel = new UserModel(); 
		$idOrganizer = $_GET['i'];
		$org = (object)$organizerModel->organizerById($idOrganizer);
		$organizerModel->deleteOrganizer($idOrganizer);
		$uModel->delete($org->idUser);
		return redirect()->to(base_url('organisateur-list-refonte'));
	}
	public function updateOrganizer()
	{
		$organizerModel = new OrganizerModel(); 
		$organizer = new Organizer(); 
		$organizer->idOrganizer = $this->request->getVar('id');
		$organizer->name = $this->request->getVar('name');
		$organizer->description = $this->request->getVar('description');
		$organizer->phone = $this->request->getVar('phone');
		$organizer->email = $this->request->getVar('email');
		


		if (! $this->validate([
 			'name' => 'required',
 			'phone' => 'required',
 			'email' => 'required'
 			])){
				$organizerModel = new OrganizerModel(); 
				$data['organizer'] = (object)$organizerModel->organizerById($organizer->idOrganizer);
				$data['OrganizerList'] = $organizerModel->organizerList();
				echo view('organisateur_ajout',$data);
 			}
 			else{
 				$organizerModel->updateOrganizer($organizer->idOrganizer,$organizer);
			return redirect()->to(base_url('organizer_list'));

		}
	
	}
	public function saveOrganizerC($name,$description,$phone,$email)
	{
		$organizerModel = new OrganizerModel(); 
		$organizer = new Organizer(); 
		$organizer->name = $this->request->getVar('name');
		$organizer->description = $this->request->getVar('description');
		$organizer->phone = $this->request->getVar('phone');
		$organizer->email = $this->request->getVar('email');
		$organizerModel->saveOrganizer($organizer);
		return redirect()->to(base_url('organizer_list'));
	
	}
	public function savePost()
	{
		$mdp = $this->request->getVar('mdp');
		$user = new User();
		$user->login = $this->request->getVar('login');
		$user->password = password_hash($mdp, PASSWORD_BCRYPT);
		$user->name = $this->request->getVar('name');
		$user->firstname = '';
		$user->phone = $this->request->getVar('phone');
		$user->email = $this->request->getVar('email');
		$user->adresse = $this->request->getVar('adresse');
		$user->typeUser = 'organisateur';
		$user->idOrganizer = 0;
		
		$userModel = new UserModel(); 
		$userModel->save($user);
		$query = $userModel->userConnexion($user->login,$mdp);
		if($query != null)
		{
			$organizerModel = new OrganizerModel(); 
			$organizer = new Organizer(); 
			$organizer->name = $this->request->getVar('name');
			$organizer->description = $this->request->getVar('description');
			$organizer->phone = $this->request->getVar('phone');
			$organizer->email = $this->request->getVar('email');
			$organizer->idUser = ((object)$query)->idUser;
			$organizerModel->saveOrganizer($organizer);
		}
		$listOrg = $organizerModel->organizerList();
		echo json_encode($listOrg);
	}
	
	public function saveUser($mdp,$username,$name,$firstname,$tel,$email,$adresse,$image,$tmpimg)
	{
		$encrypter = \Config\Services::encrypter();
		$mdpCrypted = $encrypter->encrypt($txt);
		//echo($mdpCrypted);
		$user = new User();
		$user->login = $username;
		$user->password = password_hash($mdp, PASSWORD_BCRYPT);
		$user->name = $name;
		$user->firstname = $firstname;
		$user->phone = $tel;
		$user->email = $email;
		$user->adresse = $adresse;
		$user->idOrganizer = 0;
		$user->typeUser = "organisateur";
		$user->isActive =0;
		
		$target_dir = 'assets/img/';
		$target_file = $target_dir . basename($image);
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
		else {
			if (move_uploaded_file($tmpimg, $target_file)) {
				echo "The file ". basename($image). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
			$user->image = base_url($target_file);
		}
		$userModel = new UserModel(); 
		
		try{
			$data['user'] = $userModel->userRegistration($user);
		}
		catch (Exception $ex) {
			//return redirect()->to(base_url('organisateur/ajout'));
		}
	}
	
	public function save()
	{
		$organizerModel = new OrganizerModel(); 
		$organizer = new Organizer(); 

		$name = $this->request->getVar('name');
		//$firstname = $this->request->getVar('firstname');
		$adresse = $this->request->getVar('adresse');
		$email = $this->request->getVar('email');
		$tel = $this->request->getVar('phone');
		$username = $this->request->getVar('login');
		$mdp = $this->request->getVar('pwd');
		$nif = $this->request->getVar('nif');
		$stat = $this->request->getVar('stat');
		$description = $this->request->getVar('description');
		$image = "tt";
		//$image = $this->request->getVar('image');
		$image = $_FILES["image"]["name"];
		$tmpimage = $_FILES["image"]["tmp_name"];
		
		if (! $this->validate([
 			'name' => 'required',
			// 'firstname' => 'required',
			 'adresse' => 'required',
			 'email' => 'required',
			 'login' => 'required',
			 'pwd' => 'required'
 			])){
				$organizerModel = new OrganizerModel(); 
				$data['OrganizerList'] = $organizerModel->organizerList();
				echo view('organisateur_ajout',$data);
 			}
			 else
			 {
				$this->saveUser($mdp,$username,$name,"",$tel,$email,$adresse,$image,$tmpimage);
				$userModel = new UserModel(); 
				$query = $userModel->userConnexionRegister($username,$mdp);
				if($query != null)
				{
					$organizer->idUser = ((object)$query)->idUser;
					$organizer->name = $username;
					$organizer->phone = $tel;
					$organizer->description = $description;
					$organizer->email = $email;
					$organizer->nif = $nif;
					$organizer->stat = $stat;
					$organizerModel->saveOrganizer($organizer);
					$this->sendEmail($email);
				}
				return redirect()->to(base_url('login?su=56'));
		}
	}
/*
	
public function sendEmail($email){
	$to = $email;
	$subject = "INSCRIPTION REUSSIE";
	$message = "Merci pour votre inscription. D&eacute;sormais vous pouvez ajouter votre &eacute;venement.";

	$email = \Config\Services::email();

	$email->setTo($to);
	$email->setFrom('landrie.event@gmail.com', 'Confirm Registration');

	$email->setSubject($subject);
	$email->setMessage($message);
	$email->send();
}*/

public function sendEmail($email){
	$to = $email;
	$subject = "INSCRIPTION REUSSIE";
	$message = "Merci pour votre inscription. Pour valider votre compte , veuillez cliquer sur ce lien : <a href='".base_url()."/activate?i=".$email."'>Activation compte</a>";

	$email = \Config\Services::email();

	$email->setTo($to);
	$email->setFrom('landrie.event@gmail.com', 'Confirm Registration');

	$email->setSubject($subject);
	$email->setMessage($message);
	$email->send();
}
public function activateAccount()
{
	$userModel = new UserModel(); 
	$email = $_GET['i'];
	$userModel->activate($email);
	return redirect()->to(base_url('login?sa=59'));
	
}
	public function update()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$organizerModel = new OrganizerModel(); 
			$data['organizer'] = (object)$organizerModel->organizerById($id);
			$data['OrganizerList'] = $organizerModel->organizerList();
			echo view('organisateur_ajout',$data);
		}
		else{
	  		return redirect()->to(base_url('login'));
	  	}

	}
  	public function followListByIdUser(){
  		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
		  $organizerModel = new OrganizerModel();
		  $data['OrganizerList'] =  $organizerModel->followListByIdUser($_GET['id']);
		  echo view('organisateur_liste', $data);
		}
		else{
	  		return redirect()->to(base_url('login'));
	  	} 
    }
	public function searchOrganizerfollowedByIdUser()
	{
		$session = \Config\Services::session(); 		
	  	 if(isset($_SESSION['userSession']) == TRUE){
		  $eventModel = new EventModel();
		  $organizerModel = new OrganizerModel();
		  $listOrg =  $organizerModel->followListByIdUser($_GET['id']);
		 $listOrgToView =  array();
			foreach ($listOrg as $org) {
				$unorg = new Organizer();
				$unorg->idOrganizer = $org->idOrganizer;
				$unorg->name = $org->name;
				$unorg->description = $org->description;
				$unorg->phone = $org->phone;
				$unorg->email = $org->email;
				$unorg->idOrganizer = $org->idOrganizer;
				$countFollow=$organizerModel->countFollow($unorg->idOrganizer);
	            foreach($countFollow as $c) $unorg->nbFollow = $c->nbFollow;
				$nEvt =  array();
				$nEvt = $eventModel->countEventSearchByOrganizer($unorg->idOrganizer);
				foreach ($nEvt as $e) {
					$unorg->nbEvents = $e->nbEvents;
				}
				array_push($listOrgToView,$unorg);
			}
			$data['OrganizerList'] = $listOrgToView;
			$uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		$data['search'] = 1;
		  echo view('organisateur_liste_refonte', $data);
		
		}
		  
		else{
	  		return redirect()->to(base_url('connexion'));
	  	} 
	}
	public function updateUserOrg()
	{
		$organizerModel = new OrganizerModel(); 
		$organizer = new Organizer(); 
		$email = $this->request->getVar('email');
		$name = $this->request->getVar('name');
		//$firstname = $this->request->getVar('firstname');
		$phone = $this->request->getVar('phone');
		$username = $this->request->getVar('login');
		$adresse = $this->request->getVar('adresse');
		$iUser = $this->request->getVar('iUser');
		$desc = $this->request->getVar('description');
		$nif = $this->request->getVar('nif');
		$stat = $this->request->getVar('stat');
		$photoIm = $this->request->getVar('image');
		$iUser = $this->request->getVar('iUser');
		$organizerModel->updateOrg($name,$desc,$phone,$email,$iUser,$nif,$stat);
		$userModel = new UserModel();
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
            $photoIm = base_url($target_file);
			  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}
		$userModel->updateUserOr($username,$phone,$email,$adresse,$photoIm,$iUser);
		return redirect()->to(base_url('organisateur-list-refonte'));
	}
	public function saveUserOrg()
	{
		try 
		{
			$mdp = $this->request->getVar('password');
			$user = new User();
			$login = $this->request->getVar('login');
			$password = password_hash($mdp, PASSWORD_BCRYPT);
			$name = $this->request->getVar('name');
			$tel = $this->request->getVar('phone');
			$email = $this->request->getVar('email');
			$adresse = $this->request->getVar('adresse');
			$nif = $this->request->getVar('nif');;
			$stat = $this->request->getVar('stat');;
			$user->idOrganizer = 0;
			$image = $_FILES["image"]["name"];
			$tmpimage = $_FILES["image"]["tmp_name"];		
			$userModel = new UserModel(); 
			
			$userByEmailExist = $userModel->userByEmailOrganizer($email);
			if($userByEmailExist != null)
			{
				return redirect()->to(base_url('organisateur/ajout'));
			}
			$this->saveUser($password,$login,$name,"",$tel,$email,$adresse,$image,$tmpimage);
			$query = $userModel->userConnexion($login,$password);
			if($query != null)
			{
				$organizerModel = new OrganizerModel(); 
				$organizer = new Organizer(); 
				$organizer->name = $this->request->getVar('name');
				$organizer->description = $this->request->getVar('description');
				$organizer->phone = $this->request->getVar('phone');
				$organizer->email = $this->request->getVar('email');
				$organizer->idUser = ((object)$query)->idUser;
				$organizer->nif = $this->request->getVar('nif');
				$organizer->stat = $this->request->getVar('stat');
				$res = $organizerModel->saveOrganizer($organizer);
				$this->sendEmail($organizer->email);
			}
			return redirect()->to(base_url('organisateur-list-refonte'));
		} catch (Exception $ex) {
			return redirect()->to(base_url('organisateur/ajout'));
		}
		
	
	}
}