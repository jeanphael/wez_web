<?php namespace App\Controllers;
use App\Models\CategoryModel;
use App\Entities\Category;

class CategoryController extends BaseController
{  
	public function index() { 
       $this->categoryList();
    } 
    public function liste()
	{
		$categoryModel = new CategoryModel(); 
		$data['categoryList'] = $categoryModel->categoryList();
		echo view('category_list', $data);
	}
    public function categoryList()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$categoryModel = new CategoryModel(); 
			$data['categoryList'] = $categoryModel->categoryList();
			echo view('category_list', $data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}

	public function categoryById()
	{
		$categoryModel = new CategoryModel(); 
		$idCategory = $this->request->getVar('idCategory');
		$data['categoryById'] = $categoryModel->categoryById($idCategory);
	}
	public function deleteCategory()
	{
		$categoryModel = new CategoryModel(); 
		$idCategory = $_GET['id'];
		$data['categoryById'] = $categoryModel->deleteCategory($idCategory);
		return redirect()->to(base_url('gestion/categorie'));
	}

	public function deleteCategoryOld()
	{
		$categoryModel = new CategoryModel(); 
		$idCategory = $_GET['id'];
		$data['categoryById'] = $categoryModel->deleteCategory($idCategory);
		return redirect()->to(base_url('category'));
	}

	public function saveCategory()
	{
		$category = new Category();
		$category->name = $this->request->getVar('name');
		$categoryModel = new CategoryModel(); 

		if (! $this->validate([
		 'name' => 'required'

		 ])){

			$data['categoryList'] = $categoryModel->categoryList();
			echo view('category_list', $data);
		
		}
		else
		{
			$categoryModel->categorySave($category);
			return redirect()->to(base_url('category'));
		}

		
	}	
	public function saveCategoryGet()
	{
		$category = new Category();
		$category->name = $this->request->getVar('libelle');
		$categoryModel = new CategoryModel(); 
		$categoryModel->categorySave($category);
		$data= $categoryModel->categoryList();
		echo json_encode($data);
	}	
	public function saveCategoryModal()
	{
		$category = new Category();
		$category->name = $this->request->getVar('libelle');
		$categoryModel = new CategoryModel(); 
		$categoryModel->categorySave($category);
		$data= $categoryModel->categoryList();
		echo json_encode($data);
	}	
	public function update()
	{
		$session = \Config\Services::session(); 		
	  	if(isset($_SESSION['userSession']) == TRUE){
			$id = $_GET['id'];
			$categoryModel = new CategoryModel(); 
			$data['categoryList'] = $categoryModel->categoryList();
			$data['category'] = (object)$categoryModel->categoryById($id);
			echo view('category_list',$data);
		}
	  	else{
	  		return redirect()->to(base_url('login'));
	  	}
	}

	public function updateCategory()
	{
		$id = $this->request->getVar('id');
		$categoryModel = new CategoryModel(); 
		$category = new Category(); 
		$category->name = $this->request->getVar('name');

		if (! $this->validate([
		 'name' => 'required'

		 ])){

			$data['categoryList'] = $categoryModel->categoryList();
			$data['category'] = (object)$categoryModel->categoryById($id);
			echo view('category_list', $data);
		
		}
		else
		{
			$categoryModel->updateCategory($id,$category);
			return redirect()->to(base_url('category'));
		}

		
	}
	public function updateCategoryModal()
	{
		try
		{
			$id = $this->request->getVar('id');
			$categoryModel = new CategoryModel(); 
			$category = new Category(); 
			$category->name = $this->request->getVar('libelle');
			$categoryModel->updateCategory($id,$category);
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