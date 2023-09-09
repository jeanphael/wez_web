<?php namespace App\Controllers;
use App\Models\AgendaModel;
use App\Entities\Agenda;

class AgendaWSController extends BaseController
{
	public function index() { 
         $this->agendaList();
    } 
    public function agendaList()
	{
		$agendaModel = new AgendaModel(); 
		$data = $agendaModel->getAll();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function agendaListByIdUser()
	{
		$agendaModel = new AgendaModel(); 
		$idUser = $this->request->getVar('idUser');
		$data= $agendaModel->agendaListByIdUser($idUser);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

	public function agendaSave($idUser,$idEvent,$idOrganizer,$idPlace,$idPrice)
	{
		$agendaModel = new AgendaModel();
		$agenda = new Agenda();
		$agenda->idUser = $this->request->getVar('idUser');
		$agenda->idEvent = $this->request->getVar('idEvent');
		$agenda->idOrganizer = $this->request->getVar('idOrganizer');
		$agenda->idPlace = $this->request->getVar('idPlace');
		$agenda->idPrice = $this->request->getVar('idPrice');
		$agendaModel->agendaSave($agenda);
	}
}