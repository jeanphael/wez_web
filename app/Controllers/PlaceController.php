<?php namespace App\Controllers;
use App\Models\PlaceModel;
use App\Entities\Place;
use App\Models\CityModel;
use App\Entities\City;
class PlaceController extends BaseController
{
	public function index() { 
       $this->placeList();
    } 
    public function liste()
	{
		$placeModel = new PlaceModel(); 
		$data['placeList'] = $placeModel->placeListWithCity();
		$CityModel = new CityModel(); 
		$data['cityList'] = $CityModel->cityList();
		echo view('place_list', $data);
	}
    public function placeList()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeListWithCity();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			echo view('place_list', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	public function deletePlace()
	{
		$placeModel = new PlaceModel();
		$idPlace = $_GET['idPlace'];
		$placeModel->deletePlace($idPlace);
		$CityModel = new CityModel(); 
		$data['cityList'] = $CityModel->cityList();
		return redirect()->to(base_url('gestion/lieu'));
	}
	public function deletePlaceOld()
	{
		$placeModel = new PlaceModel();
		$idPlace = $_GET['idPlace'];
		$placeModel->deletePlace($idPlace);
		$CityModel = new CityModel(); 
		$data['cityList'] = $CityModel->cityList();
		return redirect()->to(base_url('place'));
	}
	public function placeById()
	{
		$placeModel = new PlaceModel(); 
		$idPlace = $this->request->getVar('idPlace');
		$data['placeById'] = $placeModel->placeById($idPlace);
	}

	public function savePlace()
	{
		$place = new Place();
		$place->name = $this->request->getVar('name');
		$place->lng = $this->request->getVar('lng');
		$place->lat = $this->request->getVar('lat');
		$place->idCity = $this->request->getVar('city');
		$placeModel = new PlaceModel(); 

		if (! $this->validate([
		 'name' => 'required',
		 'lng' => 'required|decimal',
		 'lat' => 'required|decimal',
		 'city' => 'required',

		 ])){

			$data['placeList'] = $placeModel->placeListWithCity();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
		
			echo view('place_list', $data);
		
		}
		else
		{
			$placeModel->save($place);
			//var_dump($place);
			return redirect()->to(base_url('place'));
		}
		
	}
	
	public function updatePlaceAjax()
	{	
		try
		{
			$place = new Place();
			$place->name = $this->request->getVar('libelle');
			$place->lng = $this->request->getVar('lng');
			$place->lat = $this->request->getVar('lat');
			$place->idCity = $this->request->getVar('city');
			$idPlace = $this->request->getVar('idPlace');
			
			
			$placeModel = new PlaceModel(); 
			$placeModel->updatePlace($idPlace,$place);
			
			$arr = array('status' => 200,'message' =>'success','data'=> null);
			header('Content-Type:application/json');
			echo json_encode($arr);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}

	}		
	public function savePlaceGet()
	{
		$place = new Place();
		$place->name = $this->request->getVar('libelle');
		$place->lng = $this->request->getVar('lng');
		$place->lat = $this->request->getVar('lat');
		$place->idCity = $this->request->getVar('city');
		$placeModel = new PlaceModel(); 
		$placeModel->save($place);
		$data= $placeModel->placeListWithCity();
		echo json_encode($data);


	}	

	public function getListPlaceJsonFormat()
	{
		$placeModel = new PlaceModel(); 
		$data= $placeModel->placeListWithCity();
		echo json_encode($data);
	}	
	
	public function update()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeListWithCity();
			$data['place'] = (object)$placeModel->placeById($id);
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			echo view('place_list',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	public function updatePlace()
	{
		$id = $this->request->getVar('idPlace');
		$placeModel = new PlaceModel(); 
		$place = new Place(); 
		$place->name = $this->request->getVar('libelle');
		$place->lng = $this->request->getVar('lng');
		$place->lat = $this->request->getVar('lat');
		$place->idCity = $this->request->getVar('city');
		$placeModel->updatePlace($id,$place);
		return redirect()->to(base_url('gestion/lieu'));
	}
	public function updatePlaceOld()
	{
		$id = $this->request->getVar('id');
		$placeModel = new PlaceModel(); 
		$place = new Place(); 
		$place->name = $this->request->getVar('name');
		$place->lng = $this->request->getVar('lng');
		$place->lat = $this->request->getVar('lat');
		$place->idCity = $this->request->getVar('city');


		if (! $this->validate([
		 'name' => 'required',
		 'lng' => 'required|decimal',
		 'lat' => 'required',
		 'city' => 'required|decimal',

		 ])){

			$data['placeList'] = $placeModel->placeListWithCity();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$data['place'] = (object)$placeModel->placeById($id);
			echo view('place_list', $data);
		
		}
		else
		{
			$placeModel->updatePlace($id,$place);
			return redirect()->to(base_url('place'));
		}

		
	}
}