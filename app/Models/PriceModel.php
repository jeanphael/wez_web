<?php namespace App\Models;

use CodeIgniter\Model;

class PriceModel extends Model
{
  protected $table = 'price';
  protected $primaryKey = 'idPrice';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'value','idEvent'];

   /* public function priceList()
   {
	  	return $this->findAll();
	}
	*/
	public function priceList(){
		$db = \Config\Database::connect();
		$builder=$db->table('price');
		$builder->select('price.*,event.name as nameEvent');
		$builder->join('event', 'event.idEvent = price.idEvent');
		$builder->orderBy('event.idEvent , price.value asc');
		$query = $builder->get()->getResult();
		return $query;		 
	}
	public function priceListByIdOrg($idOrg){
		$db = \Config\Database::connect();
		$builder=$db->table('price');
		$builder->select('price.*,event.name as nameEvent');
		$builder->join('event', 'event.idEvent = price.idEvent');
		$builder->join('organizer', 'event.idOrganizer = organizer.idOrganizer');
		$builder->where('event.idOrganizer',$idOrg);
		$builder->orderBy('event.idEvent , price.value asc');
		$query = $builder->get()->getResult();
		return $query;		 
	}

	public function priceById($id)
   {
		return $this->asArray() ->where(['idPrice' => $id]) ->first();
	}	
  public function savePrice($price)
   {
     $this->save($price);
  } 
  public function updatePrice($id,$price)
   {
     $this->update($id,$price);
  } 
   public function deletePrice($id)
   {
     $this->delete($id);
  } 
  public function deleteTrfByIdEvent($id){
		$this->where('idEvent', $id)->delete();
	}
  public function priceByEvent($idE){
		$db = \Config\Database::connect();
		$builder=$db->table('price');
		$builder->select('price.idPrice,price.name,price.value');
		 $builder->join('event', 'event.idEvent = price.idEvent');
		$builder->where('price.idEvent', $idE);
		$builder->orderBy('price.value asc');
		$query = $builder->get()->getResult();
		return $query;		 
	}
}