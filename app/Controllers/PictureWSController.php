<?php namespace App\Controllers;
use App\Models\PictureModel;
use App\Entities\Picture;

class PictureWSController extends BaseController
{
	public function index() { 
       $this->pictureList();
    } 
    public function pictureList()
	{
		$pictureModel = new PictureModel(); 
		$data= $pictureModel->pictureList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function savePicture()
	{
		$pictureModel = new PictureModel(); 
		$picture = new Picture();
		$picture->name = $this->request->getVar('name');
		$picture->url = $this->request->getVar('url');
		$pictureModel->savePicture($picture);
	}
	public function updatePicture()
	{
		$pictureModel = new PictureModel(); 
		$id = $this->request->getVar('id');
		$picture = new Picture();
		$picture->name = $this->request->getVar('name');
		$picture->url = $this->request->getVar('url');
		$pictureModel->updatePicture($id,$picture);
	}
	public function deletePicture()
	{
		$pictureModel = new PictureModel(); 
		$id = $this->request->getVar('id');
		$pictureModel->deletePicture($id);
	}

}