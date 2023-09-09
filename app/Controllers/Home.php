<?php namespace App\Controllers;
use App\Entities\Event;
use App\Models\EventModel;

class Home extends BaseController
{
	public function index()
	{
		//getting liste event to validate
		$eventModel = new EventModel();
		$data['listEvents'] = $eventModel->eventDetails(true,'toValidate');
		$data['listEventsNotPublished'] = $eventModel->eventDetails(false,'notpublished');
		echo view('index',$data);
	}

}
