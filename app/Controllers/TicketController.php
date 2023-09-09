<?php namespace App\Controllers;
use App\Models\TicketModel;
use App\Entities\Ticket;

class TicketController extends BaseController
{
	public function index() { 
      	$ticketModel = new TicketModel();
      	$data = $ticketModel->getAll();
		echo view('pdv_ajout_ticket', $data);
    } 
	public function getPdvByIdEvent() { 
      	$ticketModel = new TicketModel();
      	$data = $ticketModel->getPdvByIdEvent();
		echo json_encode($data);
    } 
	public function savePdvByIdEvent(){
		$ticketModel = new TicketModel();
		$t = new Ticket();
      	$t->idPointOfSale = $this->request->getVar('idPointOfSale');
      	$t->idEvent = $this->request->getVar('idEvent');
		$ticketModel->save($t);
	}
}