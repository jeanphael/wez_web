<?php namespace App\Controllers;
use App\Models\CityModel;
use App\Entities\City;

class CityWSController extends BaseController
{
	public function index() { 
       $this->cityList();
    } 
    public function cityList()
	{
		$cityModel = new CityModel(); 
		$data= $cityModel->cityList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

}