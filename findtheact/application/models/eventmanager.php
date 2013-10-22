<?php
/*
 * Created on Sep 2, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php
Class Eventmanager extends CI_Model
{

/***************************** all act agency  Details******************************/
 function login($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
  
 /***************************** end ******************************/
 }
 
 /***************************** event search ******************************/
 
 function searchevent($location,$skill,$price){
       
 	$skillid=$this->db->get_where('subskill', array('sub_category_name' => $skill));
        $data=$skillid->result();
        $skillidval=$data[0]->id;
		
        
 	///$sql = "select * from act where eventname= ?  and `location` like ? and `skill` like ? ";
        $sql = "select * from profile where `address` like '%$location%' and `subcategory` like '%$skillidval%' and `mincost`<='$price' ";
		
 	///$this -> db -> query($sql ,array($event,'%'.$location.'%','%'.$skill.'%'));
        $que1=$this -> db -> query($sql);
 	return $que1->result();
 }
 
 /***************************** end ******************************/
 
 
/***************************** get all the distinct location ******************************/

  function locations()
 {
 	
//build a query to get all the distinct location of all the at person from profile table
   
   $query = $this -> db -> query('select distinct(address) as loc from profile');
   
 //return the result array

   return $query->result();
 }
 
 /*****************************  end ******************************/
 
}
?>
