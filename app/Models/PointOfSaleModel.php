<?php namespace App\Models;

use CodeIgniter\Model;

class PointOfSaleModel extends Model
{
  protected $table = 'pointofsale';
  protected $primaryKey = 'idPointOfSale';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'lat','lng'];

  public function pointOfSaleList()
   {
		$db = \Config\Database::connect();
		$builder = $db->table('pointofsale');
		$builder->select('pointofsale.*');
		$builder->orderBy('pointofsale.name','ASC');
		//$builder->join('place', 'pointofsale.idPlace = place.idPlace');
		$query = $builder->get()->getResult();
		return $query;
	} 

	public function searchPos($textToFind)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('pointofsale');
		$builder->like('pointofsale.name', $textToFind);
		$query = $builder->get()->getResult();
		return $query;
	}
	
	public function pointOfSaleById($id)
   {
		$db = \Config\Database::connect();
		$builder = $db->table('pointofsale');
		$builder->select('pointofsale.*');
		//$builder->join('place', 'pointofsale.idPlace = place.idPlace');
		$builder->where('pointofsale.idPointOfSale', $id);
		$query = $builder->get()->getResult();
		return $query;
	}

	public function pointOfSaleByIdEvent($idEvent)
   {
		$db = \Config\Database::connect();
		$builder = $db->table('ticket');
		$builder->select('event.idEvent as idEvent,ticket.idPointOfSale,event.name as eventName,pointofsale.name as namePointOfSale');
		$builder->join('event', 'ticket.idEvent = event.idEvent');
		$builder->join('pointofsale', 'ticket.idPointOfSale = pointofsale.idPointOfSale');
		//$builder->join('place', 'pointofsale.idPlace = place.idPlace');
		$builder->where('ticket.idEvent', $idEvent);
		$query = $builder->get()->getResult();
		return $query;
	}

	public function savePointOfSale($pointOfSale)
	{
		$this->save($pointOfSale);
	}

	public function updatePointOfSale($id,$pointOfSale)
	{
		$this->update($id,$pointOfSale);
	}
	public function deletePointOfSale($id)
	{
		$this->where('idPointOfSale', $id)->delete();
	}
	
}