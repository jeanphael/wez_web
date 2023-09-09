<?php namespace App\Controllers;
use App\Models\PlaceModel;
use App\Entities\Place;

class PlaceWSController extends BaseController
{
	public function index() { 
       $this->placeList();
    } 
    public function placeList()
	{
		$placeModel = new PlaceModel(); 
		$data= $placeModel->placeListWithCity();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function placeById()
	{
		$placeModel = new PlaceModel(); 
		$idPlace = $this->request->getVar('idPlace');
		$data= $placeModel->placeById($idPlace);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

	public function savePlace()
	{
		$place = new Place();
		$place->name = $this->request->getVar('name');
		$place->lat = $this->request->getVar('lat');
		$place->lng = $this->request->getVar('lng');
		$placeModel = new PlaceModel(); 
		$placeModel->save($place);
		echo $place->name."".$place->lat."".$place->lng;
	}	
	
}