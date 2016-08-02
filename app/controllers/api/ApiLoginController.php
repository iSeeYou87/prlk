<?php

include_once '../app/controllers/api/BaseApiController.php';
include_once '../app/controllers/LoginController.php';

/*
params:
	email
	password
	
response:
	auth_key
*/

class ApiLoginController extends BaseApiController {
	
	private $controller;
	
	public function beforeRender() {
		$this->isLogined = true; //подхачим, чтобы вызвать processingApi
		parent::beforeRender();
	}
	
	public function processingApi() {
		$this->controller = new LoginController();
		
		$this->success = $this->controller->login();
		
		if ($this->success) {
			$this->response[Auth::FIELD_KEY] = Account::getAuthKey();
		}
		
		$this->mergeAlerts($this->controller);
	}
	
}

?>