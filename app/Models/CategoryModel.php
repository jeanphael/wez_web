<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
  protected $table = 'category';
  protected $primaryKey = 'idCategory';
  protected $returnType = 'array';
  protected $allowedFields = ['name'];

   public function searchCategory($textToFind)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('category');
		$builder->like('category.name', $textToFind);
		$query = $builder->get()->getResult();
		return $query;
	}
	 public function categoryListLimit($id,$minoumax)
	{
		
		$db = \Config\Database::connect();
		$builder = $db->table('category');
		if($minoumax !=null)
		{
			if($minoumax == 'prev'){
				/*$builder->where('category.idCategory >', $id);
				$builder->orderBy('category.idCategory ', 'DESC');*/
				$builder->where('category.idCategory <', $id);
				$builder->orderBy('category.idCategory ', 'DESC');
				
			}
			else 
			{
				$builder->where('category.idCategory >', $id);
			}
			$builder->limit(1);
		}
		else{
				$builder->limit(4);
		}
		$query = $builder->get()->getResult();
		return $query;
	}

 public function categoryListSwiper()
	{
		
		$db = \Config\Database::connect();
		$builder = $db->table('category');
		$query = $builder->get()->getResult();
		return $query;
	}
    
  public function categoryList()
   {
	  	return $this->findAll();
	} 

	public function categoryById($id)
   {
		return $this->asArray() ->where(['idCategory' => $id]) ->first();
	}
  public function categoryByName($name)
   {
    return $this->asArray() ->where(['name' => $name]) ->first();
  }
  public function categorySave($category)
   {
      return $this->save($category);
  }
  public function updateCategory($id,$category)
   {
      return $this->update($id,$category);
  }
   public function deleteCategory($idCategory)
   {
      return $this->delete($idCategory);
  }
}