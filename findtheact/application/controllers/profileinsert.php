<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class Profileinsert extends CI_controller{


/***************************** Add Act person Details ******************************/function save()
{
  
  		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		//load the upload library

		$this->load->library('upload', $config);
		
		//if image is not uploaded then give an error message
		if ( ! $this->upload->do_upload())
		{
		//echo "ifff";
			$error = array('error' => $this->upload->display_errors());
var_dump($error);
			
		}
		else
		{
		//else uoload the image in upload folder
	$data = array('upload_data' => $this->upload->data());
	//Create an instance of the insert profile model
	$this->load->model('insertprofile');
	//if isest submit then call the process function of insertprofile modeel
			if($this->input->post('submit'))
			{
	
				$this->insertprofile->process();                
			}
			//redirect the page to add act person profile
redirect('userlogin/addactmanager');
}


		}
		
	/***************************** end******************************/

}
?>
