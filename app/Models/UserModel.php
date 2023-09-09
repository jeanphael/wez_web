<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UserModel extends Model
{
  protected $table = 'user';
 protected $primaryKey = 'idUser';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'firstname'
  , 'phone','email','adresse','login','password','image','typeUser','idOrganizer','isActive'];

   public function searchUser($textToFind)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('user');
		$builder->like('user.name', $textToFind);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function searchUserAdmin($textToFind)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('user');
				
		$builder->where('user.typeUser','admin');
		$builder->having('user.name', $textToFind);
		$builder->orHavingLike('user.phone', $textToFind);
		$builder->orHavingLike('user.email', $textToFind);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function userList()
   {
	  	 $db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
       $builder->where('typeUser !=','admin');
	    $builder->where('isActive',1);
		$query = $builder->get()->getResult();
      	return $query;
	}

	public function userById($id)
   	{
		return $this->asArray() ->where(['idUser' => $id]) ->first();
	}
	
	public function loginByEmail($p)
	{
		/*$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('email', $p);
		$builder->orWhere('phone', $p);
		$query = $builder->get()->getResult();
      	return $query;*/
		return $this->asArray() ->where(['email' => $p])->orWhere(['phone' => $p])->first();
	}
	

	public function userByLogin($login)
   	{
		return $this->asArray() ->where(['login' => $login]) ->first();
	}

	public function userByLoginOrganizer($login)
   	{
		return $this->asArray() ->where(['login' => $login])
		 ->where(['typeUser' => 'organisateur'])
		  ->where(['isActive' => 1])
		 ->first();
	}
	public function userByEmailOrganizer($mail)
   	{
		return $this->asArray() ->where(['email' => $mail])
		 ->where(['typeUser' => 'organisateur'])
		  ->where(['isActive' => 1])
		 ->first();
	}
	public function userByEmailHashedOrganizer($mail)
   	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('typeUser','organisateur');
		$builder->where('isActive',1);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$email = $row->email;
			if(password_verify($email, $mail)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	public function userByEmailHashed($mail)
   	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$email = $row->email;
			if(password_verify($email, $mail)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	

	public function userByEmail($email)
   	{
		return $this->asArray() ->where(['email' => $email]) ->first();
	}

	public function userRegistration($data)
	{
		try {  
		$user = $this->insert($data); 
			/*if ($this->save($user) === false) {    echo "ts mety"; }
			else{
				
			}*/		
		} 
		catch (\Exception $e) { 
		   die($e->getMessage()); 
		} 
		return null;
		 
	}
		
	public function userConnexionWS($login,$pwd)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('login',$login);
		$builder->where('typeUser','utilisateur');
		$builder->where('isActive',1);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$mdps = $row->password;
			if(password_verify($pwd, $mdps)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	public function userConnexionWithoutUser($id,$pwd)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('isActive',1);
		$builder->where('idUser',$id);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$mdps = $row->password;
			if(password_verify($pwd, $mdps)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	public function userConnexion($login,$pwd)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('login',$login);
		$builder->where('isActive',1);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$mdps = $row->password;
			if(password_verify($pwd, $mdps)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	public function userConnexionRegister($login,$pwd)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('login',$login);
			$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$mdps = $row->password;
			if(password_verify($pwd, $mdps)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	public function userConnexionWithoutPass($login)
	{
		return $this->asArray() ->where(['login' => $login]) ->first();
	}
	public function userConnexionOrganizer($login,$pwd)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('login',$login);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$mdps = $row->password;
			if(password_verify($pwd, $mdps)) {
				return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		return null;
	}
	
	public function updateProfilUser($id,$user)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');	
		if($user->name!=null) $builder->set('name', $user->name);
		if($user->firstname!=null)  $builder->set('firstname',$user->firstname);
		if($user->password!=null) $builder->set('password', $user->password);
		if($user->phone!=null) $builder->set('phone', $user->phone);
		if($user->adresse!=null) $builder->set('adresse',$user->adresse);
		if($user->email!=null) $builder->set('email', $user->email);
		if($user->image!=null) $builder->set('image', $user->image);
		$builder->where('idUser', $id); $builder->update();
		//$this->update($id,$user);
	}
	
	public function updateUser($id,$user)
	{
		$this->update($id,$user);
	}
	public function deleteUser($id)
	{
		$this->where('idUser', $id)->delete();
	}
	public function getTicketDetails()
	{
		
	}
  	public function listeUserLikingAnEvent($id){
      $db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
        $builder->join('likeevent','likeevent.idUser = user.idUser');
		$builder->where('likeevent.idEvent',$id);
		$query = $builder->get()->getResult();
      	return $query;
    }
	public function listFollowers($id){
      $db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
        $builder->join('follow','follow.idUser = user.idUser');
		$builder->where('follow.idOrganizer',$id);
		$query = $builder->get()->getResult();
      	return $query;
    }
	public function userListAdmin()
	{
		//return $this->asArray() ->where(['idUser' => $id]);
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
      	$builder->where('typeUser','admin');
		$query = $builder->get()->getResult();
      	return $query;
	}
	public function userSimpleList()
	{
		//return $this->asArray() ->where(['idUser' => $id]);
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
      	$builder->where('typeUser','utilisateur');
		$query = $builder->get()->getResult();
      	return $query;
	}
	public function updateAdmin($email,$name,$username,$phone,$firstname,$iUser)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->set('email', $email);
		$builder->set('name',$name);
		$builder->set('login',$username);
		$builder->set('phone',$phone);
		$builder->set('firstname',$firstname);
		$builder->where('idUser', $iUser); $builder->update();
	}
	
	public function updateUserOrganizer($name,$description,$phone,$email,$iUser,$nif,$stat)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('organizer');
		
		$builder->set('name',$name);
		$builder->set('description',$description);
		$builder->set('phone',$phone);
		$builder->set('email', $email);
		$builder->set('stat',$stat);
		$builder->set('nif',$nif);
						  
									 
		$builder->where('idUser', $iUser); $builder->update();
	
   
	
			  
	}
	
	public function updateUserOrg($username,$name,$firstname,$phone,$email,$adresse,$photoIm,$iUser)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->set('name',$name);
		$builder->set('firstname',$firstname);
		$builder->set('login',$username);
		$builder->set('phone',$phone);
		$builder->set('email', $email);
		$builder->set('adresse',$adresse);
		$builder->set('image',$photoIm);
		$builder->where('idUser', $iUser); $builder->update();
	
   
	
			  
	}
	public function updateUserOr($username,$phone,$email,$adresse,$photoIm,$iUser)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->set('login',$username);
		$builder->set('phone',$phone);
		$builder->set('email', $email);
		$builder->set('adresse',$adresse);
		$builder->set('image',$photoIm);
		$builder->where('idUser', $iUser); $builder->update();
	  
	}
	public function activate($email)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->set('isActive',1);
		$builder->where('email', $email); $builder->update();
	}

}