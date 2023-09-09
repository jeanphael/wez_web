<?php namespace App\Controllers;
use App\Models\OrganizerModel;
use App\Models\EventModel;
use App\Models\FollowModel;
use App\Entities\Organizer;

class OrganizerWSController extends BaseController
{
	public function index() { 
       $this->organizerList();	
    } 
    public function organizerList()
	{
		$organizerModel = new OrganizerModel(); 
		$data= $organizerModel->organizerList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function organizerById()
	{
		$organizerModel = new OrganizerModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data = $organizerModel->organizerById($idOrganizer);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function organizerDetails()
	{
		$organizerModel = new OrganizerModel();
		$eventModel = new EventModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data['organizerDetails'] = $organizerModel->organizerById($idOrganizer);
		$data['organizerEvents'] = $eventModel->eventSearchByOrganizer($idOrganizer);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function organizerFollow()
	{
		$followModel = new FollowModel(); 
		$idUser = $this->request->getVar('idUser');
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data = $followModel->follow($idOrganizer,$idUser);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function countFollow()
	{
		$organizerModel = new OrganizerModel();
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data = $organizerModel->countFollow($idOrganizer);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	
	public function deleteOrganizer()
	{
		$organizerModel = new OrganizerModel(); 
		$idOrganizer = $this->request->getVar('idOrganizer');
		$data['organizer'] = $organizerModel->deleteOrganizer($idOrganizer);
	}
	public function updateOrganizer()
	{
		$organizerModel = new OrganizerModel(); 
		$organizer = new Organizer(); 
		$organizer->idOrganizer = $this->request->getVar('idOrganizer');
		$organizer->name = $this->request->getVar('name');
		$organizer->description = $this->request->getVar('description');
		$organizer->phone = $this->request->getVar('phone');
		$organizer->email = $this->request->getVar('email');
		$organizerModel->updateOrganizer($organizer->idOrganizer,$organizer);
	}
	public function saveOrganizer($name,$description,$phone,$email)
	{
		$organizerModel = new OrganizerModel(); 
		$organizer = new Organizer(); 
		$organizer->name = $this->request->getVar('name');
		$organizer->description = $this->request->getVar('description');
		$organizer->phone = $this->request->getVar('phone');
		$organizer->email = $this->request->getVar('email');
		$organizerModel->saveOrganizer($organizer);
	}
	
	public function followListByIdUser(){
  		$organizerModel = new OrganizerModel();
		$data =  $organizerModel->followListByIdUser($this->request->getVar('id'));
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
    }
}