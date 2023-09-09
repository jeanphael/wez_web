<?php namespace App\Controllers;
use App\Models\CityModel;
use App\Entities\City;

class CityController extends BaseController
{
	public function index() { 
       $this->cityList();
    } 
    public function liste()
	{
		$CityModel = new CityModel(); 
		$data['cityList'] = $CityModel->cityList();
		echo view('city_list', $data);
	}
    public function cityList()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$cityModel = new CityModel(); 
			$data['cityList'] = $cityModel->cityList();
			echo view('city_list', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	public function deleteCity()
	{
		$cityModel = new CityModel();
		$idCity = $_GET['idCity'];
		$cityModel->deleteCity($idCity);
		return redirect()->to(base_url('city'));
	}
	public function cityById()
	{
		$cityModel = new CityModel(); 
		$idCity = $this->request->getVar('idCity');
		$data['cityById'] = $CityModel->cityById($idCity);
	}

	public function saveCity()
	{
		$cityModel = new CityModel(); 
		$city = new City();
		$city->name = $this->request->getVar('name');
		if (! $this->validate([
 			'name' =>'required'
 			])){
			$data['cityList'] = $cityModel->cityList();
			echo view('city_list', $data);
		}
		else{
			$cityModel = new CityModel(); 
			$cityModel->save($city);
			return redirect()->to(base_url('city'));
		}

	}
	public function saveCityPost()
	{
		$city = new City();
		$city->name = $this->request->getVar('libelle');
		$cityModel = new CityModel(); 
		$cityModel->save($city);
		$data= $cityModel->cityList();
		echo json_encode($data);
	}
	public function update()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$cityModel = new CityModel(); 
			$data['cityList'] = $cityModel->cityList();
			$data['city'] = (object)$cityModel->cityById($id);
			echo view('city_list',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	public function updateCity()
	{
		$id = $this->request->getVar('id');
		$cityModel = new CityModel(); 
		$city = new City(); 
		$city->name = $this->request->getVar('name');
		


		if (! $this->validate([
 			'name' =>'required'
 			])){
			$data['cityList'] = $cityModel->cityList();
			$data['city'] = (object)$cityModel->cityById($id);

			echo view('city_list', $data);
		}
		else{
			$cityModel->updateCity($id,$city);
			return redirect()->to(base_url('city'));
		}
	}
}