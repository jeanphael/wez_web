<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\LikeEvent;

class LikeEventModel extends Model
{
  protected $table = 'likeevent';
  protected $primaryKey = 'idLikeEvent';
  protected $returnType = 'array';
  protected $allowedFields = ['idEvent','idUser'];

 public function like($idEvent,$idUser){
    try {  
      $entityLike = new LikeEvent();
      $entityLike->idEvent = $idEvent;
      $entityLike->idUser = $idUser;
       // Vérifier si déjà suivi
        $data = $this->verify($entityLike);
        // si non , rajouter dans la table
        if(empty($data)){
          $data = $this->insert($entityLike);
        }
        // si oui , supprimer dans la table 
        else $data = $this->deleteEntity($entityLike);

     } 
    catch (\Exception $e) { 
       die($e->getMessage()); 
    } 
    return null;   
  }
   public function verify($entity){
    $db = \Config\Database::connect();
    $builder=$db->table('likeevent');
    $builder->select('*');
    $array = ['idUser' => $entity->idUser, 'idEvent' => $entity->idEvent]; 
    $builder->where($array); 
    $query = $builder->get()->getResult();
    return $query;
  }

   public function deleteEntity($entity){
    $db = \Config\Database::connect();
    $builder=$db->table('likeevent');
    $array = ['idUser' => $entity->idUser, 'idEvent' => $entity->idEvent]; 
   // $builder->where($array); 
   $builder->where($array);
   $builder->delete(); 
  }

  
  public function getIDEventByIdUser($iduser)
   {
    $db = \Config\Database::connect();
    $builder=$db->table('likeevent');
    $builder->select('idEvent');
    $builder->where('likeevent.idUser', $iduser);
    $query = $builder->get()->getResult();
    return $query;
	}
}
