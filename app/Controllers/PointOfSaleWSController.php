<?php namespace App\Controllers;
use App\Models\PointOfSaleModel;
use App\Entities\PointOfSale;

class PointOfSaleWSController extends BaseController
{
	public function index() { 
        $this->pointOfSaleList();
		//return view('event_list',$data);
    } 
    public function pointOfSaleList()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$data= $pointOfSaleModel->pointOfSaleList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function pointOfSaleById()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$id = $this->request->getVar('id');
		$data= $pointOfSaleModel->pointOfSaleById($id);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function pointOfSaleByIdEvent()
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$idEvent = $this->request->getVar('idEvent');
		$data = $pointOfSaleModel->pointOfSaleByIdEvent($idEvent);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function savePointOfSale($pointOfSale)
	{
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSale = new PointOfSale(); 
		$pointOfSale->name = $this->request->getVar('name');
		$pointOfSale->idPlace = $this->request->getVar('idPlace');
		$pointOfSaleModel->savePointOfSale($pointOfSale);
	}
	public function updatePointOfSale($pointOfSale)
	{
		$id = $this->request->getVar('id');
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSale = new PointOfSale(); 
		$pointOfSale->name = $this->request->getVar('name');
		$pointOfSale->idPlace = $this->request->getVar('idPlace');
		$pointOfSaleModel->updatePointOfSale($id,$pointOfSale);
	}
	public function deletePointOfSale()
	{
		$id = $this->request->getVar('id');
		$pointOfSaleModel = new PointOfSaleModel(); 
		$pointOfSaleModel->deletePointOfSale($id);
	}

}