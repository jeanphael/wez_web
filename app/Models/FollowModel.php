<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Follow;

class FollowModel extends Model
{
  protected $table = 'follow';
  protected $primaryKey = 'idFollow';
  protected $returnType = 'array';
  protected $allowedFields = ['idOrganizer','idUser'];

 public function follow($idOrganizer,$idUser){
      try {
        $entityFollow = new Follow();
        $entityFollow->idOrganizer = $idOrganizer;
        $entityFollow->idUser = $idUser;
        // Vérifier si déjà suivi
        $data = $this->verify($entityFollow);
        // si non , rajouter dans la table
        if(empty($data)){
          $data = $this->insert($entityFollow);
        }
        // si oui , supprimer dans la table 
        else $data = $this->deleteEntity($entityFollow);
     } 
    catch (\Exception $e) { 
       die($e->getMessage()); 
    } 
    return null;   
   
  }

  public function verify($entity){
    $db = \Config\Database::connect();
    $builder=$db->table('follow');
    $builder->select('*');
    $array = ['idUser' => $entity->idUser, 'idOrganizer' => $entity->idOrganizer]; 
    $builder->where($array); 
    $query = $builder->get()->getResult();
    return $query;
  }

   public function deleteEntity($entity){
    $db = \Config\Database::connect();
    $builder=$db->table('follow');
    $array = ['idUser' => $entity->idUser, 'idOrganizer' => $entity->idOrganizer]; 
   // $builder->where($array); 
   $builder->where($array);
   $builder->delete(); 
  }

}