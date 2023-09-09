<?php namespace App\Controllers;
use App\Models\PriceModel;
use App\Entities\Price;

class PriceWSController extends BaseController
{
	public function index() { 
        $this->priceList();
    } 
    public function priceList()
	{
		$priceModel = new PriceModel(); 
		$data= $priceModel->priceList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function priceById()
	{
		$priceModel = new PriceModel();  
		$idPrice = $this->request->getVar('idPrice');
		$data = $priceModel->priceById($idPrice);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	 public function priceByEvent()
	{
		$priceModel = new PriceModel(); 
		$idEvent = $this->request->getVar('id');
		$data= $priceModel->priceByEvent($idEvent);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

}