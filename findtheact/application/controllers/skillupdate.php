<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skillupdate extends CI_controller{


/****************************************** upadate skills *********************************************/


function save()
{


$this->load->model('Updateskills');

if($this->input->post('submit')){
	
	

$this->Updateskills->process();                
 }
redirect('home/addskill');




}

/****************************************** end *********************************************/






}
?>
