<?php
    class Addacts extends CI_model{  
	
	


	 
        function process($email){
		
		$chk='';
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
		//$data['skill']=$data['skill'].$sk.',';
		$chk=$chk.$sk.',';
		
		}
		
		
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
					
					
                   $this->db->insert('act',$insert);
		
		
		
		}
		
		
		}
		?>
