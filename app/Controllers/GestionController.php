<?php namespace App\Controllers;
use App\Models\CategoryModel;
use App\Entities\Category;
use App\Models\PlaceModel;
use App\Models\CityModel;
use App\Entities\Place;
use App\Models\PriceModel;
use App\Entities\Price;
use App\Models\EventModel;
use App\Entities\Event;
use App\Models\PrintPriceModel;
use App\Entities\PrintPrice;
use App\Controllers\EventController;
class GestionController extends BaseController
{

    
    public function searchCategory()
	{
		$categoryModel = new CategoryModel(); 
		$textToFind = $this->request->getVar('textToFind');
		$data=$categoryModel->searchCategory($textToFind);
		echo json_encode($data);
	}
    public function searchLieu()
	{
		$placeModel = new PlaceModel(); 
		$textToFind = $this->request->getVar('textToFind');
		$data=$placeModel->searchLieu($textToFind);
		echo json_encode($data);
	}
	public  function tarif()
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
          $eventModel = new EventModel();
        $data['listEventsToValidate'] = $eventModel->getEventToValidate();
        $data['listEventsNotPublished'] = $eventModel->getEventNotPublished();
			$uCtrl = new EventController();
			$data = $uCtrl->getDataMenu($data);
          echo view('gestion_tarif', $data);
      }
        else{
            return redirect()->to(base_url('connexion'));
        } 
    }
    public  function cout()
    {
        $session = \Config\Services::session(); 		
        $pModel = new PrintPriceModel(); 
		$data['priceFirst'] = (object)$pModel->priceFirst();
		$uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		echo view('gestion_publication',$data);
    }
    public  function categorie()
    {
        $session = \Config\Services::session(); 		
        if(isset($_SESSION['userSession']) == TRUE){
          $categoryModel = new CategoryModel(); 
          $data['categoryList'] = $categoryModel->categoryList();
        $uCtrl = new EventController();
		$data = $uCtrl->getDataMenu($data);
		echo view('gestion_categorie',$data);
      }
        else{
            return redirect()->to(base_url('connexion'));
        }
    }
    public  function lieu()
    {
        $session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$placeModel = new PlaceModel(); 
			$data['placeList'] = $placeModel->placeListWithCity();
			$CityModel = new CityModel(); 
			$data['cityList'] = $CityModel->cityList();
			$uCtrl = new EventController();
			$data = $uCtrl->getDataMenu($data);
			echo view('gestion_lieu', $data);
		}
	  	else{
	  		return redirect()->to(base_url('connexion'));
	  	}
    }
    public function updatePrintPriceAjax()
    {
        try
		{
            $pModel = new PrintPriceModel(); 
            $pri = new PrintPrice();
            $name = $this->request->getVar('name');
            $price = $this->request->getVar('price');
            $id = $this->request->getVar('id');
            $pModel->updatePrintPrice($name,$price,$id);
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