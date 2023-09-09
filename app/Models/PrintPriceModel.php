<?php namespace App\Models;

use CodeIgniter\Model;

class PrintPriceModel extends Model
{
  protected $table = 'printprice';
  protected $primaryKey = 'id';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'normal','banniere'];

   
   public function priceFirst()
   {
		return $this->asArray() ->first();
	}

	/*public function priceById($id)
   {
		return $this->asArray() ->where(['id' => $id]) ->first();
	}*/	
  public function savePrice($printPrice)
   {
     $this->save($printPrice);
  } 
  public function updatePrice($id,$printPrice)
   {
     $this->update($id,$printPrice);
  } 
	public function updatePrintPrice($name,$price,$id)
  {
    $db = \Config\Database::connect();
		$builder=$db->table('printprice');
		$builder->set($name, $price);
		$builder->where('id', $id); $builder->update();
  }
   public function deletePrice($id)
   {
     $this->delete($id);
  } 
  
  
}