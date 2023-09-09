<?php namespace App\Controllers;
use App\Models\PictureModel;
use App\Entities\Picture;

class PictureController extends BaseController
{
	public function index() { 
       $this->pictureList();
    } 
    public function pictureList()
	{
		$pictureModel = new PictureModel(); 
		$data['pictureList'] = (object)$pictureModel->pictureList();
		echo view('picture', $data);
	}
	public function savePicture()
	{
		$pictureModel = new PictureModel(); 
		$picture = new Picture();
		$target_dir = 'assets/img/';
		//$target_dir = base_url('');
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		}
		else {
		  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		    $picture->name = basename($_FILES["image"]["name"]);
			$picture->url = base_url($target_file);
			$pictureModel->updatePicture($this->request->getVar('id'),$picture);
		
		  } else {
		    echo "Sorry, there was an error uploading your file.";
		  }
		}//echo "nom evenement : ".$event->name." | date debut | ".$event->dateBegin."date fin | ".$event->dateEnd." |  organisateur :".$event->idOrganizer." | idPlace:".$event->idPlace." | idPrice:".$event->idPrice." | idcategory:".$event->idCategory;
		return redirect()->to(base_url('picture'));
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