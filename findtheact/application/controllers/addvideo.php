<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class Addvideo extends CI_controller{


/*****************************  Act manager Vedio add controller  ******************************/
public function add_video(){
	//if video field is not null
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {
            unset($config);
            $date = date("ymd");
            $configVideo['upload_path'] = 'video';
            $configVideo['max_size'] = '10240';
            $configVideo['allowed_types'] = 'mov|flv|wmv|f4v|mp4';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $date.$_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;
 //load the upload library 
            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            if (!$this->upload->do_upload('video')) {
            	//if video is not upload the throw an error message
                echo $this->upload->display_errors();
            } else {
            	//else the video is upload
                $videoDetails = $this->upload->data();
                echo "Successfully Uploaded";
                //create the instance of the inservideo model
                $this->load->model('insertvideo');
                
                //if isset submit then call the process function of insertvideo model

			if($this->input->post('submit'))
			{
				
				$this->insertvideo->process();                
			}
            }
            //redirect the page to addvideo  viw page
            redirect("userlogin/addvedio");
        }
        }
        
		
/*****************************  end  ******************************/
        }

/************************************** file path: application/controllers/ ************************************/
?>

