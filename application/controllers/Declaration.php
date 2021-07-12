<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Declaration extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('filing_model');
		$this->load->model('common_model');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}
	


	
	public function declarationstmt(){	
		$data['applet'] = $this->common_model->getAppletName();
		$data['state'] = $this->common_model->getStateName();
		$this->load->view('filing/declaration.php',$data);
	
	}
		
	public function save(){		
 	$salt=mt_rand();
	$salt=$salt;
  	$name= ($this->input->post('name'));
 	$f_name= ($this->input->post('f_name'));
 	$place= ($this->input->post('place'));
 	$date= ($this->input->post('date1'));
 
 
  $declaration = array(
   'salt'=>$salt,
   'name' => $name,
   'f_name' => $f_name,
   'place' => $place,
   'date' => $date,
   
  ); 
  $employeeId = $this->filing_model->addDeclaration($declaration);
  $data['message'] =  "";
  if($employeeId){
   $data['message'] =  "Employee Saved Successfully!..";
  }

  redirect('/document/documentfiling');
 
 }
 
 public function employeelist(){
  $query = $this->HomeModel->getEmployee();
  if($query){
   $data['EMPLOYEES'] =  $query;
  }
  $this->load->view('result.php', $data);
 }
 
 public function getdistrict()
 {
 $query = $this->common_model->getDistrictNameByID($this->input->post('stateid'));
 
 //echo "<pre>";
 //print_r($query);
 if(!empty($query))
 {
 foreach($query as $value)
 {
 echo '<option value="'.$value->district_code.'">'.$value->name.'</option>';
 }
 
 }

}
}
?>
 
			
			

	
	
	
}