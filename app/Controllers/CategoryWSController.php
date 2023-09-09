<?php namespace App\Controllers;
use App\Models\CategoryModel;
use App\Entities\Category;

class CategoryWSController extends BaseController
{
	public function index() { 
       $this->categoryList();
    } 
    public function categoryList()
	{
		$categoryModel = new CategoryModel(); 
		$data= $categoryModel->categoryList();
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function categoryListLimit()
	{
		$categoryModel = new CategoryModel(); 
		$idCategory = $this->request->getVar('id');
		$prevornext = $this->request->getVar('prevornext');
		$data= $categoryModel->categoryListLimit($idCategory,$prevornext);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}
	public function categoryById()
	{
		$categoryModel = new CategoryModel(); 
		$idCategory = $this->request->getVar('idCategory');
		$data= $categoryModel->categoryById($idCategory);
		$arr = array('status' => 200,'message' =>'success','data'=> $data);
		header('Content-Type:application/json');
		echo json_encode($arr);
	}

	public function saveCategory()
	{
		$category = new Category();
		$category->name = $this->request->getVar('name');
		$category->lat = $this->request->getVar('lat');
		$category->lng = $this->request->getVar('lng');
		$categoryModel = new CategoryModel(); 
		$categoryModel->save($category);
		echo $category->name."".$category->lat."".$category->lng;
	}	
	
}