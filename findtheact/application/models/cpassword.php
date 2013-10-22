<?php
    class Cpassword extends CI_model{  
	
	

	
	 
        function cpassw($email,$pass,$cpass){
       //built a query to get the existing password from registration table where email equal to the login act person email and type =2
	$query = $this->db->get_where('registration',array('email'=>$email,'type'=>2));
	$data=$query->result();
	//get the password of the corresponding login user
	$pwd=$data[0]->pwd;
	//if the getting password is not equal to the post password value the through an invalid password error
	if($pwd!=$cpass)
	{
	    echo "Current Password Is Not Valid";
	}
	else{
	    
	  //else built a query to update the existing password with the new password of the corresponding user  
	     $insert = array(
                        'pwd'=>$pass
                                     
                    );
					//var_dump($insert);
		    $this->db->where('email', $email,'type',1);
		 $q=$this->db->update('registration', $insert);
		 if($q)
		 {
		    echo "Successfully Password changed.";
		 }
	    
	}
	
		}
		
		
		}
		?>
