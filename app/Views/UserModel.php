<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UserModel extends Model
{
  protected $table = 'user';
 protected $primaryKey = 'idUser';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'firstname'
  , 'phone','email','adresse','login','password','image','typeUser','idOrganizer'];

  public function userList()
   {
	  	return $this->findAll();
	}

	public function userById($id)
   	{
		return $this->asArray() ->where(['idUser' => $id]) ->first();
	}

	public function userByLogin($login)
   	{
		return $this->asArray() ->where(['login' => $login]) ->first();
	}

	public function userByEmail($email)
   	{
		return $this->asArray() ->where(['email' => $email]) ->first();
	}

	public function userRegistration($data)
	{
		try {  
		$user = $this->insert($data);   
		var_dump($user);
			/*if ($this->save($user) === false) {    echo "ts mety"; }
			else{
				
			}*/
			
		} 
		catch (\Exception $e) { 
		   die($e->getMessage()); 
		} 
		return null;
		 
	}

	public function userConnexion($login,$pwd)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->where('login',$login);
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$mdps = $row->password;
		}
		if(password_verify($pwd, $mdps))  return $this->asArray() ->where(['idUser' => $row->idUser]) ->first();
		else return null;
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
	
}