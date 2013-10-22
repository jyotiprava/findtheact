<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
function changeapply(actid,agencyid,appliedto)
{
//alert(val);
    $.post('<?php echo base_url()?>index.php/changeagency/change',
	{ 'actid':actid,'agncid':agencyid,'applied':appliedto},
	function(result) {
	if(result==1)
	{
alert("successfully submitted your agency changing notice");
$('#change').html('<input type="button" name="change" value="Applied"/>');
}
	//$('#profile_subcategory').html(result);
	//alert(4);
	}
	);
}
</script>
<style type="text/css">
table th{
text-align:left;

}
</style>
<div style="width:100%;height:auto;float:left; background: #ffffff;">
<table width="100%">
		<tr><th colspan="2">Act Agency Change Option</th></tr>
		<tr><th>Act Agency Name</th>
			<th>Action</th>
		</tr>
		<?php
		//get the login user emialid and store in a variable $val
		$val=$emailvalue;
		
	//built a query to get the act agency emailid under which this act person resides
		$query1 = $this -> db -> get_where('profile',array('email ='=>$val));
	    $row = $query1->row(); 
		$agencyid=$row->added_by;
		
		//get the act agency name by built a query from registration table
		$query2 = $this -> db -> get_where('registration',array('email'=>$agencyid));
	    $row2 = $query2->row(); 
		$agencyname=$row2->username;
				
		?>
		<tr><td colspan="2">Current Agency : <?php echo $agencyname?> </td></tr>
		<?php
		//get all the act person details from allacts model page
		//foreach act person get the details 
		foreach($allacts as $row)
		{
		$gemail=$row->email;
		//built a query to get the status of agency change of the login act person
		$q=mysql_query("select `status` from `agency_change` where `act_id`='$val' and `under_agency`='$agencyid' and `applied_to`='$gemail'");
		$r=mysql_fetch_array($q);
		$status=$r['status'];
		
		//if status=0 then the act person applied to change the act agency
	
		
		if(isset($status))
		{
		if($status==0)
		{
		?>
		
		<tr><td><?php echo $row->username?></td>
		
		<td id="change"><input type="button" name="change"  value="Applied"  /></td>
		
		</tr>
		<?php
		}
			//if status=1 then approved by the applied act person
		if($status==1)
		{
		?>
		<tr><td><?php echo $row->username?></td>
		
		<td id="change"><input type="button" name="change"  value="Approved" /></td>
		
		</tr>
		
		
		
		<?php
		}
		}
			//else the act person cannt apply to change the act agency
		else
		{
		?>
		<tr><td><?php echo $row->username?></td>
		
		<td id="change"><input type="button" name="change" id="change" value="Apply" onclick="changeapply('<?php echo $val?>','<?php echo $agencyid?>','<?php echo $row->email;?>');"  /></td>
		
		</tr>
		
		
		<?php
		}
		}
		?>


</table>

</div>
