<?php namespace App\Models;

use CodeIgniter\Model;

class TokenModel extends Model
{
  protected $table = 'token';
  protected $primaryKey = 'tokenValue';
  protected $returnType = 'array';
  protected $allowedFields = ['tokenValue'];

   public function liste()
   {
	  	return $this->findAll();
	} 

	public function byId($id)
	{
		return $this->asArray()->where(['tokenValue' => $id])->first();
	}
 
  public function saveToken($token)
  {
      return $this->save($token);
  }
  public function updateToken($id,$token)
   {
      return $this->update($id,$token);
  }
   public function deleteToken($idToken)
   {
      return $this->delete($idToken);
  }
}