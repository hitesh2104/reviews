<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Commanfunction {
	
# Date Changer
	public function dateChanger($cDelimeter, $eDelimeter, $cDate){
		$rDate = '';
		$cDate = str_replace('//', '', str_replace('--', '', $cDate));
		if(!empty($cDate)){
			$pDate = explode($cDelimeter, substr($cDate,0,10));
			$rDate = $pDate[2].$eDelimeter.$pDate[1].$eDelimeter.$pDate[0];
		}
		$rDate = str_replace('00/00/0000', '', $rDate);
		return $rDate;
	}
}

?>