<?php
    class Addacts extends CI_model{  
	
	

	
	 
        function process($email){
		
		$chk='';
		  // Grab the values from the form POST
		$val=$_FILES['userfile']['name'];
		$name = $this->input->post('name');
		$eventname = $this->input->post('eventname');
		$cost1 = $this->input->post('cost1');
		$cost2 = $this->input->post('cost2');
		$location = $this->input->post('location');
		$descp = $this->input->post('descp');
		$image_process=$val;
		$skill= $this->input->post('checklist');
		$username=$email;
		
		foreach($skill as $sk)
		{
	
		$chk=$chk.$sk.',';
		
		}
		
		//store all the post variables in an array 
		
		
		$insert = array(
                        'name'=>$name,
                        'eventname'=>$eventname,
						'mincost'=>$cost1,
						'maxcost'=>$cost2,
						'location'=>$location,
						'skill'=>$chk,
						'addedby'=>$username,
						'descp'=>$descp,
						'image'=>$image_process
                    );
                    
                   //then built the insert query for inserting all data which is resides in insert array in the act table
					
					
                   $this->db->insert('act',$insert);
		
		
		
		}
		
		
		}
		?>
