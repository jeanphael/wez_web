<?php namespace App\Controllers;
use App\Models\AgendaModel;
use App\Entities\Agenda;
use App\Models\UserModel;
use App\Entities\UserAccount;

class AgendaController extends BaseController
{
	public function index() { 
         $this->agendaList();
    } 
    public function liste()
	{
		$agendaModel = new AgendaModel(); 
		$userModel = new UserModel();
    	$data['users'] = $userModel->userList();
		echo view('agenda_list_view', $data);
	}
    public function agendaList()
	{
		$agendaModel = new AgendaModel(); 
		$data['events'] = $agendaModel->getAll();
		echo view('agenda_list_view', $data);
	}
	public function agendaListByIdUser()
	{
		$agendaModel = new AgendaModel(); 
		$idUser = $this->request->getVar('idUser');
		$data['agenda'] = $agendaModel->agendaListByIdUser($idUser);
		echo view('agenda_list_view', $data);
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
		echo view('agenda_list_view', $data);
	}
}