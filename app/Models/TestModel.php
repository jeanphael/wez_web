<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class TestModel extends Model
{
  protected $table = 'test';
 protected $primaryKey = 'id';
  protected $returnType = 'array';
  protected $allowedFields = ['name'];


	public function testacron($data)
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
		

}