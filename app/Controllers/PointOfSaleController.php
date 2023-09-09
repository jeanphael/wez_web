<?php namespace App\Controllers;
use App\Models\PointOfSaleModel;
use App\Models\PlaceModel;
use App\Entities\PointOfSale;
use App\Entities\Place;
use App\Models\CityModel;
use App\Entities\City;

class PointOfSaleController extends BaseController
{

	public function search()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$textToFind = $this->request->getVar('textToFind');
		$data=$pointOfSaleModel->searchPos($textToFind);
		echo json_encode($data);
	}
	public function index() { 
        $this->pointOfSaleList();
		//return view('event_list',$data);
    } 
    public function liste()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$pointOfSaleModel = new PointOfSaleModel(); 
			$data['pointOfSaleList'] = $pointOfSaleModel->pointOfSaleList();
			echo view('pdv_liste', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	 public function ajout()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeList();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			echo view('pdv_ajout',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	 public function addTicket()
	{
		echo view('pdv_ajout_ticket');
	}
    public function pointOfSaleList()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$data['pointOfSaleList'] = $pointOfSaleModel->pointOfSaleList();
		echo view('pdv_liste', $data);
	}
	public function pointOfSaleById()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$id = $this->request->getVar('id');
		$data['pointOfSaleById'] = $pointOfSaleModel->pointOfSaleById($id);
		echo view('pdv_fiche', $data);
	}
	public function pointOfSaleByIdEvent()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$idEvent = $this->request->getVar('idEvent');
		$data['pointOfSaleByIdEvent'] = $pointOfSaleModel->pointOfSaleByIdEvent($idEvent);
		echo view('pdv_liste', $data);
	}
	public function savePointOfSale($pointOfSale)
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSale = new PointOfSale(); 
		$pointOfSale->name = $this->request->getVar('name');
		$pointOfSale->idPlace = $this->request->getVar('idPlace');
		$pointOfSaleModel->savePointOfSale($pointOfSale);
		echo view('pdv_liste');
	}
	public function save()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$placeModel = new PlaceModel(); 
		$pointOfSale = new PointOfSale(); 
		$name = $this->request->getVar('name');
		$lat = $this->request->getVar('lat');
		$lng = $this->request->getVar('lng');
		//$placeName = $this->request->getVar('placeName');
		//$idPlace = $this->request->getVar('place');
		//$pointOfSale->idPlace = $idPlace;
		$pointOfSale->name = $name;
		$pointOfSale->lat = $lat;
		$pointOfSale->lng = $lng;
		if (! $this->validate([
		 	'name' => 'required',
		 	'lng' => 'required|decimal',
		 	'lat' => 'required|decimal'

		 ])){
		 	
			$this->ajout();
		}
		else{
		//	echo "lat---".$pointOfSale->lat."lng---".$pointOfSale->lng; 
		$pointOfSaleModel->save($pointOfSale);
		
		$data['pointOfSaleList'] = $pointOfSaleModel->pointOfSaleList();
		echo view('pdv_liste', $data);
		}
	}

	public function savePost(){
		$lng = $this->request->getVar('lng');
		$lat = $this->request->getVar('lat');
		$pointOfSaleModel = new PointOfSaleModel(); 
		
			$pointOfSale = new PointOfSale(); 
			$name = $this->request->getVar('pdvName');
			$pointOfSale->name = $name;
			$pointOfSale->lng = $lng;
			$pointOfSale->lat = $lat;
			$pointOfSaleModel->save($pointOfSale);
			$data = $pointOfSaleModel->pointOfSaleList();
			echo json_encode($data);
	}
	public function savePostAjax(){
		$lng = $this->request->getVar('lng');
		$lat = $this->request->getVar('lat');
		$pointOfSaleModel = new PointOfSaleModel(); 
			$pointOfSale = new PointOfSale(); 
			$name = $this->request->getVar('pdvName');
			$pointOfSale->name = $name;
			$pointOfSale->lng = $lng;
			$pointOfSale->lat = $lat;
			$pointOfSaleModel->save($pointOfSale);
			$data = $pointOfSaleModel->pointOfSaleList();
			echo json_encode($data);
	}
	
	
	public function updatePosAjax(){
		
		$lng = $this->request->getVar('lng');
		$lat = $this->request->getVar('lat');
		$name = $this->request->getVar('pdvName');
		$id = $this->request->getVar('id');
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSale = new PointOfSale(); 
		$pointOfSale->name = $name;
		$pointOfSale->lng = $lng;
		$pointOfSale->lat = $lat;
		$pointOfSaleModel->updatePointOfSale($id,$pointOfSale);
		$arr = array('status' => 200,'message' =>'success','data'=> null);
		header('Content-Type:application/json');
		echo json_encode($arr);
			
	}
	
	
	
	public function update()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$pointOfSaleModel = new PointOfSaleModel(); 
			$placeModel = new PlaceModel(); 
			$data['pointOfSale'] = $pointOfSaleModel->pointOfSaleById($id);
			$data['placeList'] = $placeModel->placeList();
			echo view('pdv_ajout',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	 }
	}

	public function updateById($id)
	{
			
		$pointOfSaleModel = new PointOfSaleModel(); 
		$placeModel = new PlaceModel(); 
		$data['pointOfSale'] = $pointOfSaleModel->pointOfSaleById($id);
		$data['placeList'] = $placeModel->placeList();
		echo view('pdv_ajout',$data);
	}
	public function updatePointOfSale()
	{
		$id = $this->request->getVar('id');
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSale = new PointOfSale(); 
		$name = $this->request->getVar('name');
		$lat = $this->request->getVar('lat');
		$lng = $this->request->getVar('lng');
		
		$pointOfSale->name = $name;
		$pointOfSale->lat = $lat;
		$pointOfSale->lng = $lng;

		if (! $this->validate([
		 	'name' => 'required',
		 	'lng' => 'required|decimal',
		 	'lat' => 'required|decimal'

		 ])){
			$this->updateById($id);
		}
		else{	
		$pointOfSaleModel->updatePointOfSale($id,$pointOfSale);
		
		$data['pointOfSaleList'] = $pointOfSaleModel->pointOfSaleList();

		echo view('pdv_liste', $data);
		}
	}
	public function deletePointOfSale()
	{
		$id = $_GET['id'];
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSaleModel->deletePointOfSale($id);
		return redirect()->to(base_url('pos_list'));
		//echo view('pdv_liste', $data);
	}

}