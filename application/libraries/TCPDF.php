<?php
	
	if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//	ini_set('error_reporting', E_STRICT); 

	require_once APPPATH."/third_party/tcpdf/tcpdf.php"; 

	class PDF extends TCPDF 
	{ 
		public function __construct() 
		{ 
			parent::__construct(); 
		} 
	}
?>