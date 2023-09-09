<?php namespace App\Controllers;
use App\Models\PriceModel;
use App\Entities\Price;
use App\Models\EventModel;
use App\Models\PrintPriceModel;
use App\Entities\Event;

class PriceController extends BaseController
{
	public function index() { 
        $this->priceList();
    } 
    public function liste()
	{
		$session = \Config\Services::session(); 		
	  	$priceModel = new PriceModel(); 
	  	if($session->userType=="admin"){
			$data['priceList'] = $priceModel->priceList();
			$eventModel = new EventModel(); 
			$data['eventList'] = $eventModel->eventList();
		}
		else{
			$data['priceList'] = $priceModel->priceListByIdOrg($session->idOrganizer);
			$eventModel = new EventModel(); 
			$data['eventList'] = $eventModel->eventListByIdOrg($session->idOrganizer);	
		}
		echo view('price_list', $data);
	}
    public function priceList()
	{

		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$priceModel = new PriceModel(); 
			if($session->userType=="admin"){
				$data['priceList'] = $priceModel->priceList();
				$eventModel = new EventModel(); 
				$data['eventList'] = $eventModel->eventList();
			}
			else{
				$data['priceList'] = $priceModel->priceListByIdOrg($session->idOrganizer);
				$eventModel = new EventModel(); 
				$data['eventList'] = $eventModel->eventListByIdOrg($session->idOrganizer);	
			}
			echo view('price_list', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}
	public function deletePrice()
	{
		$priceModel = new PriceModel();
		$idPrice =$_GET['id']; 
		 $priceModel->deletePrice($idPrice);
		return redirect()->to(base_url('gestion/tarif'));
	}
	public function deletePriceOld()
	{
		$priceModel = new PriceModel();
		$idPrice =$_GET['id']; 
		 $priceModel->deletePrice($idPrice);
		return redirect()->to(base_url('rate'));
	}
	public function priceById()
	{
		$priceModel = new PriceModel();  
		$idPrice = $this->request->getVar('idPrice');
		$data['priceById'] = $priceModel->priceById($idPrice);
	}
	public function savePrice()
	{
		$price = new Price();
		$price->name = $this->request->getVar('name');
		$price->value = $this->request->getVar('value');
		$price->idEvent = $this->request->getVar('idEvent');
		$priceModel = new PriceModel(); 
		$priceModel->savePrice($price);
		return redirect()->to(base_url('rate'));
	}
	public function savePost()
	{
		$price = new Price();
		$price->name = $this->request->getVar('libelle');
		$price->value = $this->request->getVar('value');
		$price->idEvent = $this->request->getVar('idEvent');
		$priceModel = new PriceModel(); 
		$priceModel->savePrice($price);
		return redirect()->to(base_url('rate'));
	}
	public function savePostModal()
	{
		$price = new Price();
		$price->name = $this->request->getVar('libelle');
		$price->value = $this->request->getVar('priceValue');
		$price->idEvent = $this->request->getVar('event');
		$priceModel = new PriceModel(); 
		$priceModel->savePrice($price);
		echo json_encode($priceModel->priceList());
	}
	public function update()
	{

		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$priceModel = new PriceModel(); 
			$data['price'] = (object)$priceModel->priceById($id);
			if($session->userType=="admin"){
				$data['priceList'] = $priceModel->priceList();
				$eventModel = new EventModel(); 
				$data['eventList'] = $eventModel->eventList();
			}
			else{
				$data['priceList'] = $priceModel->priceListByIdOrg($session->idOrganizer);
				$eventModel = new EventModel(); 
				$data['eventList'] = $eventModel->eventListByIdOrg($session->idOrganizer);	
			}
			echo view('price_list',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}	
	}	
	public function updatePrice()
	{
		$id = $this->request->getVar('id');
		$priceModel = new PriceModel(); 
		$price = new Price(); 
		$price->name = $this->request->getVar('name');
		$price->value = $this->request->getVar('value');
		$price->idEvent = $this->request->getVar('idEvent');
		$priceModel->updatePrice($id,$price);
		return redirect()->to(base_url('rate'));
	}
	public function updatePostModal()
	{
		try
		{
			$id = $this->request->getVar('idPrice');
			$priceModel = new PriceModel(); 
			$price = new Price(); 
			$price->name = $this->request->getVar('libelle');
			$price->value = $this->request->getVar('pricevalue');
			$price->idEvent = $this->request->getVar('event');
			$priceModel->updatePrice($id,$price);
			$arr = array('status' => 200,'message' =>'success','data'=> null);
			header('Content-Type:application/json');
			echo json_encode($arr);
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
	}
	
}