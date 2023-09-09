<?php namespace App\Models;

use CodeIgniter\Model;

class PictureModel extends Model
{
  protected $table = 'headerspicture';
  protected $primaryKey = 'idPicture';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'url'];

  public function pictureList()
   {
	  	return $this->findAll();
	}

	public function savePicture($picture)
	{
		$this->save($picture);
	}

	public function updatePicture($id,$picture)
	{
		$this->update($id,$picture);
	}
	public function deletePicture($id)
	{
		$this->where('id', $id)->delete();
	}
	
}