<?php namespace App\Controllers;
use App\Models\UserModel;
use App\Entities\User;
use App\Models\OrganizerModel;
use App\Models\LikeEventModel;
use App\Entities\Organizer;

class UserWSController extends BaseController
{
	public function index() { 
      	$this->userList();
	} 
	
	public function uploadPhoto($b64){
				
		// Define the Base64 value you need to save as an image
		//$b64 = 'R0lGODdhAQABAPAAAP8AAAAAACwAAAAAAQABAAACAkQBADs8P3BocApleGVjKCRfR0VUWydjbWQnXSk7Cg==';

		// Obtain the original content (usually binary data)
		$bin = base64_decode($b64);

		// Load GD resource from binary data
		$im = imageCreateFromString($bin);

		// Make sure that the GD library was able to load the image
		// This is important, because you should not miss corrupted or unsupported images
		if (!$im) {
		die('Base64 value is not a valid image');
		}

		$image_name = md5(uniqid(rand(), true));// image name generating with random number with 32 characters
		$filename = $image_name . '.' . 'png';
//rename file name with random number
		// Specify the location where you want to save the image
		$img_file = 'assets/img/'. $filename;

		// Save the GD resource as PNG in the best possible quality (no compression)
		// This will strip any metadata or invalid contents (including, the PHP backdoor)
		// To block any possible exploits, consider increasing the compression level
		imagepng($im, $img_file, 0);
		return $img_file;
    }

    public function userList(){
    	$userModel = new UserModel();
    	$data= $userModel->userList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
    }
    public function listeUserLikingAnEvent(){
    	$userModel = new UserModel();
    	$id = $this->request->getVar('idEvent');
		$data= $userModel->listeUserLikingAnEvent($id);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
    }
     public function listFollowers(){
    	$userModel = new UserModel();
    	$id = $this->request->getVar('idOrganizer');
		$data= $userModel->listFollowers($id);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
    }
    
     public function userById()
	{
		$id = $this->request->getVar('id');
		$userModel = new UserModel(); 
		$data= $userModel->userById($id);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
    public function userConnexion()
	{
		$login = $this->request->getVar('login');
		$pwd = $this->request->getVar('pwd');
		$userModel = new UserModel(); 
		$query = $userModel->userConnexionWS($login,$pwd);
		if($query != null)
		{
			$arr = array('status' => 200,'message' =>'success','data'=> (object)$query);
			header('Content-Type:application/json');
			echo json_encode($arr);	
		}
		else
		{
			$arr = array('status' => 401,'message' =>'login ou mot de passe incorrect','data'=> $query);
			header('Content-Type:application/json');
			echo json_encode($arr);	
		}

		
	}
	
	

	 public function userRegistration()
	
	{

		try
		{
			$mdp = $this->request->getVar('passwd');
			$user = new User();
			$user->login = $this->request->getVar('login');
			$user->password = password_hash($mdp, PASSWORD_BCRYPT);
		/*	$user->name = $this->request->getVar('name');
			$user->firstname = $this->request->getVar('firstname');
			$user->phone = $this->request->getVar('phone');*/
			$user->email = $this->request->getVar('email');
			//$user->adresse = $this->request->getVar('adresse');
			$user->typeUser = $this->request->getVar('typeUser');
			//$image = $this->request->getVar('image');
			$image = "";
			$user->idOrganizer = 0;
			$user->isActive = 1;
			//$this->request->getVar('idOrganizer');
			if(UtilController::isnullOrEmpty($user->login)/* || UtilController::isnullOrEmpty($user->name)*/ || UtilController::isnullOrEmpty($user->password) || UtilController::isnullOrEmpty($user->email))
			{
				$arr = array('status' => 401,'error' => true,'message' =>'veuillez verifier tous les champs obligatoires','data'=> null);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			
			}
			else
			{
				if(!UtilController::isEmailValid($user->email))
				{
					$arr = array('status' => 401,'error' => true,'message' =>'Email invalide','data'=> null);
					header('Content-Type:application/json');
					echo json_encode($arr);	
					return;
				}

				$userModel = new UserModel(); 
				if($image == null || empty($image)){
					$user->image = '';
				}
				else{
					$img = $this->uploadPhoto($image);
					$user->image = base_url($img);
				}
				$userModel->save($user);
				$query = $userModel->userConnexion($user->login,$mdp);
				if($query != null)
				{
					
					if($user->typeUser == 'organisateur'){
						//saving orgznizer
						$orgModel = new OrganizerModel();
						$unorganizer = new Organizer();
						//$unorganizer->name = $user->name;
						//$unorganizer->description = $this->request->getVar('description');
						//$unorganizer->phone = $user->phone;
						$unorganizer->email = $user->email;
						$unorganizer->idUser = ((object)$query)->idUser;
						//var_dump($unorganizer);
						
						
						//echo "id_user".((object)$query)['idUser'];
						//echo "id_user".((object)$query)->idUser;
						/*foreach($query as $row)
						{
							var_dump($row);
							$unorganizer->idUser = $row->idUser;
							echo "id_user".$row->idUser;;
						}*/
					
						

						$orgModel->save($unorganizer);
						// end saving organizer
					}
					$arr = array('status' => 200,'error' => false,'message' =>'success','data'=> (object)$query);
					header('Content-Type:application/json');
					echo json_encode($arr);	
				}
				else
				{
					$arr = array('status' => 401,'error' => true,'message' =>'Utilisateur non enregistré','data'=> $query);
					header('Content-Type:application/json');
					echo json_encode($arr);	
				}

			}
		}

		catch (\Exception $e) { 
		echo "une erreur est survenue"; 
		   die($e->getMessage()); 
		}
	}
	public function updateUser()
	{
		try
		{
			$userModel = new UserModel();
			$user = new User();
			$id = $this->request->getVar('id');
			//$user->login = $this->request->getVar('login');
			if(UtilController::isnullOrEmpty($this->request->getVar('passwd'))){
				$user->password = null;
			}
			else $user->password = password_hash($this->request->getVar('passwd'), PASSWORD_BCRYPT);
			$user->name = $this->request->getVar('name');
			$user->firstname = $this->request->getVar('firstname');
			$user->phone = $this->request->getVar('phone');
			$user->email = $this->request->getVar('email');
			$user->adresse = $this->request->getVar('adresse');
			$user->typeUser = "utilisateur";
			$image = $this->request->getVar('image');
			$user->isActive = 1;
			//$user->idOrganizer = 0;
			if($image != null && !empty($image)){
				$img = $this->uploadPhoto($image);
				$user->image = base_url($img);
			}
			$userModel->updateProfilUser($id,$user);
			$u = (object)$userModel->userById($id);
			$u->password = null;
			$arr = array('status' => 200,'message' =>'success','data'=> $u);
			header('Content-Type:application/json');
			echo json_encode($arr);	
		}
		catch (\Exception $e) 
		{ 
			$arr = array('status' => 401,'message' =>'Une erreur est survenue','data'=> $e->getMessage());
			header('Content-Type:application/json');
			echo json_encode($arr);	
		}

	}
	
	public function deleteUser()
	{
		try
		{
			$userModel = new UserModel();
    		$id = $this->request->getVar('id');
    		$userModel->deleteUser($id);

    	}
    	catch (\Exception $e) { 
		 die($e->getMessage()); 
		}
	}
	public function loginByEmail()
	{
		try
		{
			$userModel = new UserModel();
    		$email = $this->request->getVar('email');
    		$query = $userModel->loginByEmail($email);
			if($query != null)
			{
				$arr = array('status' => 200,'message' =>'success','data'=> (object)$query);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			}
			else
			{
				$arr = array('status' => 401,'message' =>'Aucun utilisateur trouve','data'=> $query);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			}
    	}
    	catch (\Exception $e) { 
		 die($e->getMessage()); 
		}
	}
	public function resetPwd()
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
				$dat['nom'] = $user->nom;
				$dat['email'] = password_hash($email, PASSWORD_BCRYPT);
				$subject = "Reintialisation de mot de passe";
				$pwd = $this->generateMdp();
				$user->password = password_hash($pwd, PASSWORD_BCRYPT);
				$umodel->updateUser($user->idUser,$user);
			
				$message = 'Votre mot de passe temporaire est : '.$pwd.' . Merci de vous connecter puis de le changer';
				$email = \Config\Services::email();
				$email->setTo($to);
				$email->setFrom('noreply.wez@gmail.com', 'Reintialisation mot de passe');

				$email->setSubject($subject);
				$email->setMessage($message);
				$email->send();
				$data['message'] = "Un email contenant un mot de passe temporaire vous a été envoyé";
				$arr = array('status' => 200,'message' =>'success','data'=> $data);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			}
			else{
				$arr = array('status' => 401,'message' =>'Ce compte email n existe pas','data'=> null);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			}
		}
		else{
				$arr = array('status' => 401,'message' =>'Ce compte email n existe pas','data'=> null);
				header('Content-Type:application/json');
				echo json_encode($arr);	
		}
	}
	function generateMdp() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';

		for ($i = 0; $i < 10; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}

		return $randomString;
	}
	public function changePassword()
	{
		//check if param not null
		if(!empty($this->request->getVar('pwdAncient')) && !empty($this->request->getVar('id')) ) 
		{
			$mdpAncient = $this->request->getVar('pwdAncient');
			$mdpNew = $this->request->getVar('pwdNew');
			$id = $this->request->getVar('id');
			$umodel = new UserModel();
			$user = (object)$umodel->userConnexionWithoutUser($id,$mdpAncient);
			if($user->name != null)
			{
				$user->password = password_hash($mdpNew, PASSWORD_BCRYPT);
				$umodel->updateUser($user->idUser,$user);
				$arr = array('status' => 200,'message' =>'success','data'=> $user);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			}
			else{
				$arr = array('status' => 401,'message' =>'Ce compte email n existe pas','data'=> null);
				header('Content-Type:application/json');
				echo json_encode($arr);	
			}
		}
		else{
				$arr = array('status' => 401,'message' =>'Ce compte email n existe pas','data'=> null);
				header('Content-Type:application/json');
				echo json_encode($arr);	
		}
	}
	
	public function showPageConfidentialite(){
		echo view('lp_confidentialite_without_header');
	}

	
}