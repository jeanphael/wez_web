<?php namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
  protected $table = 'ticket';
  protected $returnType = 'array';
   protected $primaryKey = 'idEvent';
  protected $allowedFields = ['idPointOfSale', 'idEvent'];

	public function getAll()
   {
	  	return $this->findAll();
	}
	public function getPdvByIdEvent($idE){
		$db = \Config\Database::connect();
		$builder=$db->table('ticket');
		$builder->select('ticket.idEvent , pointofsale.*');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale');
		$builder->where('likeevent.idEvent', $idE);
		$builder->where('idEvent', $idE);
		$query = $builder->get()->getResult();
		return $query;	
	}
	public function deletePdvByIdEvent($id)
	{
		$this->where('idEvent', $id)->delete();
	}
}