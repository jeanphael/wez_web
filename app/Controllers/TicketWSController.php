<?php namespace App\Controllers;
use App\Models\TicketModel;
use App\Entities\Ticket;

class TicketWSController extends BaseController
{
	public function index() { 
      	$ticketModel = new TicketModel();
      	$data = $ticketModel->getAll();
		echo json_encode($data);
    } 
}