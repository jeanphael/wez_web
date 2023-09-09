<?php namespace App\Models;

use CodeIgniter\Model;

class PlaceModel extends Model
{
  protected $table = 'place';
  protected $primaryKey = 'idPlace';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'lat','lng','idCity'];

  public function searchLieu($textToFind)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('place');
				
		$builder->like('place.name', $textToFind);
		$query = $builder->get()->getResult();
		return $query;
	}
   public function placeList()
   {
	  	return $this->findAll();
	} 
    public function placeListWithCity()
   {
      $db = \Config\Database::connect();
      $builder = $db->table('place');
      $builder->select('place.*,city.name as nameCity');
      $builder->orderBy('place.name','ASC');
      $builder->join('city', 'place.idCity = city.idCity');
      $query = $builder->get()->getResult();
      return $query;
  } 
        


public function savePlace($name,$lat,$lng,$idCity)
{
  $db = \Config\Database::connect();
  $builder = $db->table('place');

  $data = [
          'name' => $name,
          'lat' => $lat,
          'lng' => $lng,
          'idCity' => $idCity,
  ];
  $builder->insert($data);
  return $db->insertID();
}

	public function placeById($id)
   {
		return $this->asArray() ->where(['idPlace' => $id]) ->first();
	}
  public function placeByName($name)
   {
    return $this->asArray() ->where(['name' => $name]) ->first();
  }
  public function placeSave($place)
   {
      return $this->save($place);
  }
   public function updatePlace($id,$place)
   {
      return $this->update($id,$place);
  }
   public function deletePlace($idPlace)
   {
      return $this->delete($idPlace);
  }
}