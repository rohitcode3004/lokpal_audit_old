<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('convertToBase64'))
 {
     function get_entrydate($date){
 	 list($day2,$month2,$year2)=explode('-',$date);
	 return $entry_date=$year2."-".$month2."-".$day2;
 }

 function get_displaydate($date=NULL){
 	if($date!=NULL){
 	 list($year2,$month2,$day2)=explode('-',$date);
	 return $display_date=$day2."-".$month2."-".$year2;
	}else{
		return '';
	}
 }
}