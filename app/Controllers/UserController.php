<?php namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TestModel;
use App\Entities\User;
use App\Entities\Test;
use App\Models\OrganizerModel;
use App\Models\CategoryModel;
use App\Controllers\EventController;

use App\Models\EventModel;


class UserController extends BaseController
{
	//debut refonte

	public function testacron()
	{
		$testModel = new TestModel(); 
		$test = new Test();
		//$timest = time();
		$test->name = 'added';
		$testModel->testacron($test);
	}
	public function searchAdmin()
	{
		$userModel = new UserModel(); 
		$textToFind = $this->request->getVar('textToFind');
		$data=$userModel->searchUserAdmin($textToFind);
		echo json_encode($data);
	}
	public function search()
	{
		$userModel = new UserModel(); 
		$textToFind = $this->request->getVar('textToFind');
		$data=$userModel->searchUser($textToFind);
		echo json_encode($data);
	}
	public function connexionRefonte()
	{
		if (isset($_COOKIE['cookname'])) {
			return redirect()->to(base_url('evenement-list-refonte'));
		}
		else{
			$data = array();
			if($_GET['su']!=null)$data['inscr'] = true;
			else $data['inscr'] = 0;
			if($_GET['sa']!=null)$data['succes'] = true;
			else $data['succes'] = 0;
			//echo view('loginrefonte',$data);
			echo view('lp_connexion',$data);
		}
//}
		
		
	}
	public function deconnexionRefonte()
	{
		$session = \Config\Services::session(); 
		if (isset($_COOKIE['cookname'])) {
			setcookie ( "cookname","" ,time()-60*60*24*365 ) ;
			setcookie ( "userName", "" ,time()-60*60*24*365) ;
			setcookie ( "userId", "",time()-60*60*24*365 ) ;
			setcookie ( "userType", "" ,time()-60*60*24*365) ;
			setcookie ( "sessionImg", "" ,time()-60*60*24*365 ) ;
			setcookie ( "user", "" ,time()-60*60*24*365 ) ;
			setcookie ( "idOrganizer", "",time()-60*60*24*365 ) ;
		}
		unset($_SESSION['userSession']);	
		$session->destroy(); 
		$data = array();
		if($_GET['su']!=null)$data['inscr'] = true;
		else $data['inscr'] = 0;
		if($_GET['sa']!=null)$data['succes'] = true;
		else $data['succes'] = 0;
		 //	$this->userList();
	  //Getting list category
	  $cmodel = new CategoryModel();
	  $listCat = $cmodel->categoryListSwiper();
	  //Getting list event
	  $data['listCat'] = $listCat;
	  echo view('lp_home',$data);
	}

	public function connexionValidationRefonte()
	{
		
		$login = $this->request->getVar('login');
		$pwd = $this->request->getVar('pwd');
		$session = \Config\Services::session(); 
		if (isset($_COOKIE['cookname'])) {
			$session->set('userSession',$_COOKIE['cookname']); 
			$session->set('userName',$_COOKIE['name'].' '.$_COOKIE['firstname'] ); 
			$session->set('userId',$_COOKIE['idUser']); 
			$session->set('userType',$_COOKIE['userType']);
			$session->set('sessionImg',$_COOKIE['sessionImg']); 
			$session->set('user',$_COOKIE['user']);
			$session->set('idOrganizer',$_COOKIE['idOrganizer']); 
			return redirect()->to(base_url('evenement-list-refonte'));
		}
		else{
			if(isset($_SESSION['userSession']))
			{
				return redirect()->to(base_url('evenement-list-refonte'));
			}
			else{
				$userModel = new UserModel(); 
				//echo $login.$pwd;
				$query = $userModel->userConnexion($login,$pwd);
				//var_dump($query);return;
				if($query != null)
				{
					$userType = (object)$query;
					if ($userType->typeUser == "utilisateur") {
						return redirect()->to(base_url('connexion'));
					}
					$session = \Config\Services::session(); 
					$session->set('userName',$userType->name.' '.$userType->firstname ); 
					$session->set('userId',$userType->idUser); 
					$session->set('userSession',$login); 
					$session->set('userType',$userType->typeUser); 
					$session->set('sessionImg',$userType->image); 
					$session->set('user',$userType); 
					$orgModel = new OrganizerModel();
					$org = (object)$orgModel->organizerByIdUser($userType->idUser);
					if(isset($org)){
						$session->set('idOrganizer',$org->idOrganizer); 
					}
					else{
						$session->set('idOrganizer',0);	
					}
					
					if ($_POST['souvenir'] == 'on') {
						setcookie ( "cookname", $login ,time()+60*60*24*365 , "/") ;
						setcookie ( "userName", $_SESSION['userName'] ,time()+60*60*24*365 , "/") ;
						setcookie ( "userId", $_SESSION['userId'] ,time()+60*60*24*365 , "/") ;
						setcookie ( "userType", $_SESSION['userType'] ,time()+60*60*24*365 , "/") ;
						setcookie ( "sessionImg", $_SESSION['sessionImg'] ,time()+60*60*24*365 , "/") ;
						setcookie ( "user", $_SESSION['userType'] ,time()+60*60*24*365 , "/") ;
						setcookie ( "idOrganizer", $_SESSION['idOrganizer'] ,time()+60*60*24*365 , "/") ;
						$_COOKIE['cookname'] =  $login ;
					}
					if($session->get('userType')== "admin")
						return redirect()->to(base_url('evenement-list-refonte'));
					else return redirect()->to(base_url('evenement-list-refonte'));
				}
				else
				{
					return redirect()->to(base_url('connexion'));
				}
			}
		}
	}

	//fin refonte
	public function index() { 
      //	$this->userList();
	  //Getting list category
	  $cmodel = new CategoryModel();
	  $listCat = $cmodel->categoryListSwiper();
	  //Getting list event
	  $data['listCat'] = $listCat;
	  echo view('lp_home',$data);
    } 
     public function liste()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$userModel = new UserModel();
	    	$data['users'] = $userModel->userList();
			echo view('utilisateur_liste', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	 public function ajout()
	{

		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			
		echo view('utilisateur_ajout');
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	 public function loginpage()
	{
		$session = \Config\Services::session(); 
		unset($_SESSION['userSession']);
		$session->destroy(); 
		echo view('login');
	}
	public function connection()
	{
		echo view('login');
	}
	public function update()
	{
		$id = $_GET['id'];
		$userModel = new UserModel(); 
		$data['user'] = (object)$userModel->userById($id);
		//echo view('utilisateur_ajout',$data);
	}


    public function formReinitPwd(){
		$data['email'] = $_GET['i'];
		echo view('utilisateur_reinitialisation',$data);
    }
	public function resetPassword(){
		echo view('utilisateur_reinitialisation_password');
    }
    public function validationReinitPwd(){

    	$login = $this->request->getVar('login');
    	$pwd = $this->request->getVar('pwd');
		$userModel = new UserModel(); 
		$userByLoginOrganizer = $userModel->userByLoginOrganizer($login);
		if(isset($userByLoginOrganizer) && $userByLoginOrganizer != null)
		{
			$data = (object)$userByLoginOrganizer;
			$data->password = password_hash($pwd, PASSWORD_BCRYPT);
			$userModel->updateUser($data->idUser,$data);
			return redirect()->to(base_url('connexion'));
		}
		else
		{
			$data['message'] = 'Compte organisateur introuvable!';
		echo view('utilisateur_reinitialisation_password',$data);
		}
		
    }

	public function validationReinitPassword(){
		$session = \Config\Services::session(); 
			
    	$login = $this->request->getVar('login');
    	$pwd = $this->request->getVar('pwd');
		$userModel = new UserModel(); 
		$userByLogin = $userModel->userByLogin($login);
		if(isset($userByLogin) && $userByLogin != null)
		{
			$dat = (object)$userByLogin;
			$dat->password = password_hash($pwd, PASSWORD_BCRYPT);
			$userModel->updateUser($dat->idUser,$dat);
			$data['user']= $_SESSION['user'];
			$organizerModel = new OrganizerModel(); 
			$idU = $_SESSION['userId'];
			$organizer = $organizerModel->organizerByIdUser($idU);
		 	$data['toUpdate']= 1;
			$data['organizer']= $organizer;
			echo view('profil',$data);
		}
		else
		{
			$data['message'] = 'Compte introuvable!';
			echo view('utilisateur_reinitialisation_password',$data);
		}
		
    }
	public function validationResetPassword(){
		$session = \Config\Services::session(); 
			
    	$login = $this->request->getVar('i');
    	$pwd = $this->request->getVar('pwd');
		$userModel = new UserModel(); 
		$userByLogin = $userModel->userByEmailHashed($login);
		if(isset($userByLogin) && $userByLogin != null)
		{
			$dat = (object)$userByLogin;
			$dat->password = password_hash($pwd, PASSWORD_BCRYPT);
			$userModel->updateUser($dat->idUser,$dat);
			return redirect()->to(base_url('connexion'));
		}
		else
		{
			$data['message'] = 'Compte introuvable!';
			echo view('utilisateur_reinitialisation_password',$data);
		}
		
    }
    

    public function userList(){
    	$userModel = new UserModel();
    	$data['users'] = $userModel->userList();
		echo view('utilisateur_liste', $data);
    }
     public function userById()
	{
		$id = $this->request->getVar('id');
		$userModel = new UserModel(); 
		$data['users'] = $userModel->userById($id);
		echo view('utilisateur_liste', $data);
	}

	public function userByLogin()
	{
		$login = $this->request->getVar('login');
		$userModel = new UserModel(); 
		$userByLogin = $userModel->userByLogin($login);	
		if(isset($userByLogin))
		{
			echo "yes";
		}
		else
		{
			echo "no";
		}
	}



	
	public function userByEmail()
	{
		$email = $this->request->getVar('email');
		$userModel = new UserModel(); 
		$userByEmail = $userModel->userByEmail($email);	
		if(isset($userByEmail))
		{
			echo "yes";
		}
		else
		{
			echo "no";
		}
	}
    public function userConn()
	{
		$login = $this->request->getVar('login');
		$pwd = $this->request->getVar('pwd');
		$userModel = new UserModel(); 
		$query = $userModel->userConnexion($login,$pwd);
		if($query != null)
		{
			$userType = (object)$query;
			if ($userType->typeUser == "utilisateur") {
				return redirect()->to(base_url('login'));
			}
			$session = \Config\Services::session(); 
			
			$session->set('userId',$userType->idUser); 
			$session->set('userName',$userType->name); 
			$session->set('userSession',$login); 
			$session->set('userType',$userType->typeUser); 
			$session->set('sessionImg',$userType->image); 
			$session->set('user',$userType); 
			$orgModel = new OrganizerModel();
			$org = (object)$orgModel->organizerByIdUser($userType->idUser);
			if(isset($org)){
				$session->set('idOrganizer',$org->idOrganizer); 
			}
			else{
				$session->set('idOrganizer',0);	
			}
			
	  		if($session->get('userType')== "admin")
	  			return redirect()->to(base_url('dashboard'));
	  		else return redirect()->to(base_url('event_list'));
		}
		else
		{
			return redirect()->to(base_url('login'));
		}
	}

	 public function userRegistration()
	{
		$mdp = $this->request->getVar('passwd');
		$encrypter = \Config\Services::encrypter();
		$mdpCrypted = $encrypter->encrypt($txt);
		//echo($mdpCrypted);
		$user = new User();
		$user->login = $this->request->getVar('login');
		$user->password = password_hash($mdp, PASSWORD_BCRYPT);
		$user->name = $this->request->getVar('name');
		$user->firstname = $this->request->getVar('firstname');
		$user->phone = $this->request->getVar('phone');
		$user->email = $this->request->getVar('email');
		$user->adresse = $this->request->getVar('adresse');
		$userModel = new UserModel(); 
		$data['user'] = $userModel->userRegistration($user);
		echo view('login', $data);
	}
	  public function save()
	{
		$mdp = $this->request->getVar('password');
		$encrypter = \Config\Services::encrypter();
		$mdpCrypted = $encrypter->encrypt($txt);
		//echo($mdpCrypted);
		$user = new User();
		$user->login = $this->request->getVar('username');
		$user->password = password_hash($mdp, PASSWORD_BCRYPT);
		
		$user->name = $this->request->getVar('name');
		$user->firstname = $this->request->getVar('firstname');
		$user->phone = $this->request->getVar('tel');
		$user->email = $this->request->getVar('email');
		$user->adresse = $this->request->getVar('adresse');
		if (! $this->validate([
		 'password' => 'required|min_length[8]|max_length[20]',
		 'username' => 'required',
		 'name' => 'required',
		 'firstname' => 'required',
		  'tel' => 'required|min_length[10]|alpha_numeric',
		  'email' => 'required|valid_email',
		  'adresse' => 'required',
		])){
			echo view('utilisateur_ajout');
		}
		else{
		$userModel = new UserModel(); 
		$data['user'] = $userModel->userRegistration($user);
		$userModel = new UserModel();
		return redirect()->to(base_url('user_list'));
		}
	}
	public function updateProfil()
	{
		$session = \Config\Services::session(); 
		$userModel = new UserModel();
    	$user = new User();
		$id = $_SESSION['userId'];
		
    	$user->login = $this->request->getVar('login');
		//$user->password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
		if(!empty($this->request->getVar('name')) )
		{
			$name = $this->request->getVar('name');$user->name = $name;
		}
		if(!empty($this->request->getVar('firstname')) )
		{
			$firstname = $this->request->getVar('firstname');$user->firstname = $firstname;
		}
		
		if(!empty($this->request->getVar('nameOrg')) )
		{
			$nameOrg = $this->request->getVar('nameOrg');
		}
		$description = $this->request->getVar('description');
		$phone = $this->request->getVar('phone');
		$user->phone = $phone;
		$email = $this->request->getVar('email');
		$user->email = $email;
		$user->adresse = $this->request->getVar('adresse');
		$nif = $this->request->getVar('nif');
		$stat = $this->request->getVar('stat');
				
		$user->image = $_SESSION['sessionImg'];
		$user->typeUser = $_SESSION['userType']; 
		
		$target_dir = 'assets/img/';
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.".$target_file;
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
	            $user->image = base_url($target_file);
			  } else {
			    echo "Sorry, there was an error uploading your file.";
			  }
			}
		$userModel->updateProfilUser($id,$user);
		if($session->get('userType')== "organisateur") {
			$organizerModel = new OrganizerModel(); 
			$organizerModel->updateOrg($nameOrg,$description,$phone,$email,$id,$nif,$stat);
		}
		$query = $userModel->userConnexionWithoutPass($user->login);
		if($query != null)
		{
			$userType = (object)$query;
			
			$session->set('userId',$userType->idUser); 
			$session->set('userName',$userType->name); 
			$session->set('userSession',$userType->login); 
			$session->set('userType',$userType->typeUser); 
			$session->set('sessionImg',$userType->image); 
			$session->set('user',$userType); 
	  		if($session->get('userType')== "admin")
	  			return redirect()->to(base_url('evenement-list-refonte'));
	  		else return redirect()->to(base_url('evenement-list-refonte'));
		} 
		return redirect()->to(base_url('evenement-list-refonte'));
	}

	public function updateUser()
	{
		$userModel = new UserModel();
    	$user = new User();
		$id = $this->request->getVar('id');
    	$user->login = $this->request->getVar('username');
		$user->password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
		$user->name = $this->request->getVar('name');
		$user->firstname = $this->request->getVar('firstname');
		$user->phone = $this->request->getVar('tel');
		$user->email = $this->request->getVar('email');
		$user->adresse = $this->request->getVar('adresse');
		$session = \Config\Services::session(); 		
		$user->image = $_SESSION['sessionImg'];
		$user->typeUser = $_SESSION['userType']; 
		
		$target_dir = 'assets/img/';
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.".$target_file;
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
	            $user->image = base_url($target_file);
			  } else {
			    echo "Sorry, there was an error uploading your file.";
			  }
			}
		$userModel->updateUser($id,$user);
		$query = $userModel->userConnexion($user->login,$this->request->getVar('password'));
		if($query != null)
		{
			$userType = (object)$query;
			
			
			$session->set('userId',$userType->idUser); 
			$session->set('userName',$userType->name); 
			$session->set('userSession',$userType->login); 
			$session->set('userType',$userType->typeUser); 
			$session->set('sessionImg',$userType->image); 
			$session->set('user',$userType); 
	  		if($session->get('userType')== "admin")
	  			return redirect()->to(base_url('dashboard'));
	  		else return redirect()->to(base_url('event_list'));
		} 
		return redirect()->to(base_url('event_list'));
	}
	
	public function deleteUser()
	{
		$userModel = new UserModel();
    	$id = $_GET['id'];
    	$userModel->deleteUser($id);
		return redirect()->to(base_url('user_list'));
	}
   public function listeUserLikingAnEvent(){
        $session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			 $userModel = new UserModel();
	    	$data['users'] = $userModel->listeUserLikingAnEvent($_GET['id']);
			echo view('utilisateur_liste_specifique', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
   }
   public function listeUserFollowingAnOrganizer(){
        $session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$userModel = new UserModel();
	    	$data['users'] = $userModel->listFollowers($_GET['id']);
			echo view('utilisateur_liste_specifique', $data);
			}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
   }

   public function testSendEmail(){
	echo 'envoi email begin';

	$email = \Config\Services::email();
	

$email->setFrom('miatech.mada@gmail.com', 'Mia tech Admin');
//$email->setTo('jeanphael@gmail.com');
$email->setTo('hajatiana.ramamonjisoa@yahoo.com');
//$email->setCC('another@another-example.com');
//$email->setBCC('them@their-example.com');

$email->setSubject('Email Test');
$data = array('name' => 'Mia name', 
              'email' => 'mia email',
              'phone' => '031542 phone',
              'date' => '12/04/1998 mia');
			 $message =  view('new_user', $data);
$email->setMessage($message);
if ($email->send()) {
    echo "Email sent!";
} else {
    echo $email->printDebugger();
    return false;
}
}


	function chart(){
		$eventModel = new EventModel(); 
		//var_dump($eventModel->getAll());
		//return;
			$resultArray = $eventModel->getAll();
		$dateArray=array();
		$quantityArray=array();
		
		foreach($resultArray as $row)
		{
			array_push($dateArray,$row['description']);
			array_push($quantityArray,$row['idEvent']);
		}
		$data['dateArray'] = $dateArray;
		$data['quantityArray'] = $quantityArray;
		//var_dump($quantityArray); return;

		echo view('pdf_view', $data);
	}

	public function listeAdminRefonte()
	{
		$session = \Config\Services::session(); 		
        $userModel = new UserModel();
    	$data['userList'] = $userModel->userListAdmin();
		$uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		echo view('administrateur_liste_refonte', $data);
	}
	public function listeRefonte()
	{
		$session = \Config\Services::session(); 		
        $userModel = new UserModel();
		$data['userList'] = $userModel->userSimpleList();
		$uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		echo view('utilisateur_liste_refonte', $data);
	}
	public function pageAjoutAdmin()
	{
		$uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		echo view('administrateur_ajout_refonte',$data);
	}
	public function pageAjoutOrganisateur()
	{
		$uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		echo view('organisateur_ajout_refonte',$data);
	}
	public function pageUpdateAdmin()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['i'];
			$userModel = new UserModel(); 
			$data['user'] = (object)$userModel->userById($id);
			$data['toUpdate'] = 1;
			$uCtrl = new EventController();
			$data = $uCtrl->getDataMenu($data);
			echo view('administrateur_ajout_refonte',$data);
		  }
		  else{
			return redirect()->to(base_url('connexion'));
		}
	}
	public function pageUpdateOrganizer()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['i'];
			$organizerModel = new OrganizerModel(); 
			$data['toUpdate'] = 1;
			$data['user'] = $organizerModel->organizerDetail($id);
			$uCtrl = new EventController();
			$data = $uCtrl->getDataMenu($data);
			echo view('organisateur_ajout_refonte',$data);
		}
		else{
	  		return redirect()->to(base_url('connexion'));
	  	}
	
	}
	public function pageDeleteAdmin()
	{
		$userModel = new UserModel();
    	$id = $_GET['i'];
    	$userModel->deleteUser($id);
		return redirect()->to(base_url('administrateur-list-refonte'));
	}
	public function pageDeleteOrg()
	{
		$userModel = new UserModel();
    	$id = $_GET['i'];
    	$userModel->deleteUser($id);
		return redirect()->to(base_url('organisateur-list-refonte'));
	}
	
	public function pageDeleteUser()
	{
		$userModel = new UserModel();
    	$id = $_GET['i'];
    	$userModel->deleteUser($id);
		return redirect()->to(base_url('utilisateur-list-refonte'));
	}
	public function pageDeleteOrganizer()
	{
		$organizerModel = new OrganizerModel(); 
		$idOrganizer = $_GET['i'];
		$organizerModel->deleteOrganizer($idOrganizer);
		return redirect()->to(base_url('organisateur-list-refonte'));
	}
	public function saveUserAdmin()
	{
		
		$email = $this->request->getVar('email');
		$nom = $this->request->getVar('name');
		$prenom = $this->request->getVar('firstname');
		$phone = $this->request->getVar('phone');
		$login = $this->request->getVar('username');
		$pwd = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
		$user = new User();
		$user->name = $nom; 
		$user->firstname = $prenom; 
		$user->phone = $phone ; 
		$user->email = $email; 
		$user->typeUser = 'admin'; 
		$user->adresse = ''; 
		$user->password = $pwd;
		$user->login = $login;
		$user->idOrganizer = 0;
		$userModel = new UserModel(); 
		
		$data['user'] = $userModel->userRegistration($user);
		
		return redirect()->to(base_url('administrateur-list-refonte'));
	}
	public function updateUserAdmin()
	{
		$iUser = $this->request->getVar('iUser');
		$email = $this->request->getVar('email');
		$nom = $this->request->getVar('name');
		$prenom = $this->request->getVar('firstname');
		$phone = $this->request->getVar('phone');
		$username = $this->request->getVar('username');
		$userModel = new UserModel();
		$userModel->updateAdmin($email,$nom,$username,$phone,$prenom,$iUser);
		return redirect()->to(base_url('administrateur-list-refonte'));
	}
	public function pageProfil()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$data['user']= $_SESSION['user'];
			$organizerModel = new OrganizerModel(); 
			$idOrganizer = $_SESSION['userId'];
			$organizer = $organizerModel->organizerByIdUser($idOrganizer);
		 	$data['toUpdate']= 1;
			$data['organizer']= $organizer;
			$uCtrl = new EventController();
			$data = $uCtrl->getDataMenu($data);
			echo view('profil',$data);
		}
		else redirect()->to(base_url('connexion'));
	}
	public function pageDeleteMonCompte()
	{
		$userModel = new UserModel();
    	$id = $_GET['i'];
    	$userModel->deleteUser($id);
		return redirect()->to(base_url('profil'));
	}
	public function changePwd()
	{
		echo view('user_reset_pwd');
	}
	public function resetPwdRefonte()
	{
		//check if param not null
		if(!empty($this->request->getVar('login')))
		{
			$email = $this->request->getVar('login');
			$umodel = new UserModel();
			$user = (object)$umodel->loginByEmail($email);
			if($user->name != null)
			{
				//check if email exists in user
				//send email
				$to = $email;
				$data['nom'] = $user->nom;
				$data['email'] = password_hash($email, PASSWORD_BCRYPT);
				$subject = "Reintialisation de mot de passe";
				$message = view('mailResetPwd',$data);
				$email = \Config\Services::email();
				$email->setTo($to);
				$email->setFrom('noreply.wez@gmail.com', 'Reintialisation mot de passe');

				$email->setSubject($subject);
				$email->setMessage($message);
				$email->send();
				$data['message'] = "Un email vous a &eacute;t&eacute; envoy&eacute;";
				echo view('user_reset_pwd',$data);
			}
			else{
				$data['message'] = "Ce compte email n'existe pas";
				echo view('user_reset_pwd',$data);
			}
		}
		else{
				$data['message'] = "Le compte email n'existe pas";
				echo view('user_reset_pwd',$data);
		}
	}
	
	public function lpconnexion()
	{
		echo view('lp_connexion');
	}
	public function lpregistration()
	{
		echo view('lp_registration');
	}
	public function lphome()
	{
		echo view('lp_home');
	}
	public function lputilisation()
	{
		echo view('lp_utilisation');
	}
	public function lpconfidentialite()
	{
		echo view('lp_confidentialite');
	}
}