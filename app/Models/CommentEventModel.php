<?php namespace App\Models;

use CodeIgniter\Model;

class CommentEventModel extends Model
{
  protected $table = 'commentevent';
  protected $returnType = 'array';
   protected $primaryKey = 'idcommentevent';
  protected $allowedFields = ['idUser', 'idEvent','datecomment','comment'];

	public function getAll()
   {
	  	return $this->findAll();
	}
	public function listComments($idE)
	{
		$db = \Config\Database::connect();
		$builder=$db->table('commentevent');
		$builder->select('commentevent.* , user.name, user.firstname,user.typeUser');
		$builder->join('user', 'user.idUser = commentevent.idUser');
		$builder->where('commentevent.idEvent', $idE);
		$query = $builder->get()->getResult();
		return $query;	
	}
	public function saveComm($comment)
	{
		$this->save($comment);
	}
}