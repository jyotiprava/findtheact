<?php
Class Allacts extends CI_Model
{

/*************************************** view all event manager details *******************************/
//call this function by passing login user emailid
 function allactdetails($uid)
 {
 
 //build a query to retrieve the act agency name under which the login act person resides
 
 $query1 = $this -> db -> get_where('profile',array('email'=>$uid));
 $row = $query1->row(); 

//get the act agency name and store in a varible called agencyid

$agencyid=$row->added_by;

//if the agencyid is not null

 if($agencyid!='')
 {
//built a query to get all the act agency name except under which the act person resides
   $query = $this -> db -> get_where('registration',array('type'=>'1','email !='=>$agencyid));

  //return the result value
     return $query->result();
 }
 
   
 }
 /*************************************************** End *************************************************/
 
 
 
}
?>
