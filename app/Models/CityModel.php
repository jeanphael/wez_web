<?php namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
  protected $table = 'city';
  protected $primaryKey = 'idCity';
  protected $returnType = 'array';
  protected $allowedFields = ['name'];

   public function cityList()
   {
	  	return $this->findAll();
	} 

	public function cityById($id)
   {
		return $this->asArray() ->where(['idCity' => $id]) ->first();
	}
  public function cityByName($name)
   {
    return $this->asArray() ->where(['name' => $name]) ->first();
  }
  public function citySave($city)
   {
      return $this->save($city);
  }
   public function updateCity($id,$city)
   {
      return $this->update($id,$city);
  }
   public function deleteCity($idcity)
   {
      return $this->delete($idcity);
  }
}