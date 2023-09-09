<?php namespace App\Models;

use CodeIgniter\Model;

class OrganizerModel extends Model
{
  protected $table = 'organizer';
  protected $primaryKey = 'idOrganizer';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'description','phone','email','idUser','nif','stat'];

  public function organizerList()
   {
	  	//return $this->findAll();
		$db = \Config\Database::connect();
		$builder=$db->table('organizer');
		$builder->select('organizer.*,user.image');
		$builder->join('user', 'user.idUser = organizer.idUser');
		$builder->where('user.isActive =', 1);
		$query = $builder->get()->getResult();
		return $query;
		//	return $this->findAll();
	}
	public function searchOrganizer($textToFind)
	{
							  
		$db = \Config\Database::connect();
		$builder = $db->table('organizer');
		$builder->join('user', 'user.idUser = organizer.idUser');
		$builder->like('organizer.name', $textToFind);
		
		$builder->orLike('organizer.email', $textToFind);
		$builder->orLike('organizer.phone', $textToFind);
		$builder->orLike('organizer.description', $textToFind);
		$builder->where('user.isActive =', 1);
		$query = $builder->get()->getResult();
		return $query;
	}							 

	public function organizerById($id)
   {
		return $this->asArray() ->where(['idOrganizer' => $id]) ->first();
	}
	public function organizerByIdUser($id)
   {
		return $this->asArray() ->where(['idUser' => $id]) ->first();
	}
	public function saveOrganizer($organizer)
	{
		$this->save($organizer);
	}

	public function updateOrganizer($id,$organizer)
	{
		$this->update($id,$organizer);
	}
	public function deleteOrganizer($id)
	{
		$this->where('idOrganizer', $id)->delete();
	}
	public function followListByIdUser($id)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('organizer');
		$builder->select('organizer.*,user.image,follow.idUser');
		$builder->join('follow', 'organizer.idOrganizer = follow.idOrganizer');
		$builder->join('user', 'organizer.idUser = user.idUser');
		$builder->where('follow.idUser =', $id);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function userByIdOrganizer($id)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$builder->join('organizer', 'organizer.idUser = user.idUser');
		$builder->where('organizer.idOrganizer =', $id);
		$query = $builder->get()->getResult();
		return $query;
	}
			
	 public function countFollow($idE){
		$db = \Config\Database::connect();
		$builder=$db->table('organizer');
		$builder->select('count(follow.idUser) as nbFollow');
		 $builder->join('follow', 'organizer.idOrganizer = follow.idOrganizer');
		$builder->where('follow.idOrganizer', $idE);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function organizerFollow($idOrg,$idUser){
		
	}
	public function activate($idUser){
		$db = \Config\Database::connect();
		$builder=$db->table('user');
		$builder->select('user.*');
		$query = $builder->get();
		foreach ($query->getResult() as $row)  {
			$id = $row->idUser;
			if(password_verify($id,$idUser)) {
				$user = (object)$this->asArray() ->where(['idUser' => $row->idUser]) ->first();
			}
			
		} 
		$build = $db->table('user');
		$data = [
		'isActive' => 1,
		];
		$build->where('idUser', $user->idUser);
		$build->update($data);
	}
	public function organizerDetail($idE){
		$db = \Config\Database::connect();
		$builder=$db->table('organizer');
		$builder->select('organizer.*,user.login , user.adresse , user.image, user.firstname');
		 $builder->join('user', 'organizer.idUser = user.idUser');
		$builder->where('organizer.idOrganizer', $idE);
		$builder->where('user.isActive =', 1);
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function updateOrg($name,$description,$phone,$email,$iUser,$nif,$stat)
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
	
}