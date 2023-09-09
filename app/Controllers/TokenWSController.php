<?php namespace App\Controllers;
use App\Models\TokenModel;
use App\Entities\Token;


class TokenWSController extends BaseController
{
	public function index() { 
      	$this->liste();
    } 
    public function liste()
	{
		$tokenModel = new TokenModel(); 
		return $tokenModel->findAll();
	}
	public function saveToken()
	{
		try
		{
			$tokenModel = new TokenModel(); 
			$token = new Token();
			$token->tokenValue = $this->request->getVar('token');
			//$token->idUser = $this->request->getVar('idUser');
			$query=$tokenModel->byId($token->tokenValue);
			if($query == null){
				$tokenModel->saveToken($token);
			}
			//var_dump ($token); return;
			$arr = array('status' => 200,'error' => false,'message' =>'success','data'=> null);
			header('Content-Type:application/json');
		echo json_encode($arr);
		}
		
		catch (Exception $e)
		{
			echo 'Exception reçue : ',  $e->getMessage(), "\n";
		}

	}
}