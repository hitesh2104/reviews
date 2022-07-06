<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller 
{ 
	public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->sessionData = $this->session->userdata();
		$this->load->model("test_model");
	}
	
	
	public function read_csv(){
		$file = fopen('uploads/csv/job.csv', 'r');
		$i = 0;
		while (($line = fgetcsv($file)) !== FALSE) {
			if($i != 0){
				print_r($line); 
				echo "<br>";
				
				$this->test_model->save_jobs($line[1], $line[2], $line[3], $line[4], $line[5]);	
			}
			$i++;
		}
		fclose($file);
	}
	
	public function test_email(){
		echo $attachment_file = "uploads/ah_infographic.pdf";
		new_registration_mail("Meenesh Jain",'j.meenesh@gmail.com',"Qwerty@1", $attachment_file);
		
	}
	
	public function soap_clientTest(){
		echo '<pre>';
		report_error();
		$ns = base_url("webservices/1_1_2/wb?wsdl");
		$this->load->library("nusoap_library"); 
		$this->soapclient = new nusoap_client($ns, false); 
		$err = $this->soapclient->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';

		}
		$getCountryParameters = array (
			"appId" => 80,
			"positionLat" => 22,
			"positionLong" =>75 
		);
		
		$getLoginParamters = array( 
			'appId' => "80", 
			'positionLat' => "22.75",
			'positionLong' => "75.88", 
			'emailAddress' => "shantam@mailinator.com", 
			'password' => "Qwerty@1",
			'mobileNumber' => "2121",
			'deviceId' => "c10efa2985976111",
			'deviceBytes' => "0",
			'appVersion' => "1.33", 
			'osVersion' => "6.0", 
			'handset' => "iPhone",
			'resourceType' => "ios",
			'countryCode' => "14",
			'faceStatus' => "1",
			'appType' => "1"
		);
		$result = $this->soapclient->call('Login', $getLoginParamters);
		print_r($result);
	}
}

