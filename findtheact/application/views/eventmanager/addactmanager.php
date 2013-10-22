<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
function getsubskill(val)
{
	//call ajax to get all the subskills of the selected skill by passing skill id
    $.post('<?php echo base_url()?>index.php/pages/subcategory',
	{ 'id':val},
	function(result) {
//get the result and print the result in subskill field
	$('#profile_subcategory').html(result);

	}
	);
}
    

</script>
<style>
.contact{
            float: left;
              margin-top: 5px;
            background-color: #CB4486;
text-shadow: 0 1px 0 #73264C;
padding: 10px;
 font-family: arial;
 font-size: 14px;
 color: #fff;
 margin-left: 10px;
  border-radius: 3px;
        }
		</style>
<div id="showsearch" style="width: 980px; height: auto;">
<div style="width: 480px; height: auto; float: left;">

		    <?php echo form_open_multipart('profileinsert/save'); ?>
                            <table style="width:460px; height:650px;font-family: arial; font-size: 14px; padding: 10px; color: #005c91;">
                                <tr>
                                    <td colspan="2">
                                       <h10>About your act or business:</h10>
                                    </td>
                                </tr>
								<tr><td> Email:</br>
					<input type="text" name="email" class="textbox" style="width: 200px;"/></br>
					<span style="font-size: 12px; color: #bfbfbf;">Type carefully, this is where your leads will be sent. Please read our privacy policy.</span></td>
					<td>
                                        Create a Password:</br>
					<input type="password" name="password" class="textbox"/></br>
                                    </td>
					</tr>
                                <tr>
                                    <td colspan="2">
                                        Professional Name:</br>
                                        <input type="text" name="pname" class="textbox"/>
										<input type="hidden" name="addedby" value="<?php echo $emailvalue?>"  />
										</br>
					<span style="font-size: 12px; color: #bfbfbf;">What is your act or business name?
Examples: "The Moondance Band", "Elite Catering"</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Your Main Category:</br>
                                        <select class="textbox" name="category" style="width: 220px;"  onchange="getsubskill(this.value);">
                                <option value="">Click to browse Categories</option>
                                <?php
                                //get all the skills from skill model
					foreach($skills as $row)
											
					{
					echo "<option value='".$row->slno."'>". $row->skillname."</option>";
					}
				?>
                                
                                    
					
					</select></br>
					<span style="font-size: 12px; color: #bfbfbf;">Once you get signed up, you can add additional categories.</span>
					
				    </td>
				    <td>
					<select class="textbox" name="subcategory" style="width: 170px;" id="profile_subcategory">
					<option>Click to browse Main Categories</option>
					
					</select>
					</br>
					<span style="font-size: 12px; color: #bfbfbf;">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
					
                                        City or Zip Code :</br>
                                        <input type="text" name="zip" class="textbox"/></br>
					<span style="font-size: 12px; color: #bfbfbf;">Example: "65804" or "Springfield" (US and Canada only)</span>
                                    </td>
                                </tr>
								 </tr>
								<tr>
									<td>Minimum Cost:<br/>
									<input type="text" name="mincost" class="textbox" />
								
									</td>
									</tr>
									<tr>
									
								<td>Maximum Cost:<br/>
									<input type="text" name="maxcost" class="textbox" />
								
									</td>
								
								
								</tr>
                                <tr>
                                    <td colspan="2">
                                        Describe your services:</br>
					<span style="font-size: 12px; color: #bfbfbf;">
						Here's your chance to sell! Provide an accurate summary of the services you provide.
Please do not put phone numbers or web addresses in this area, and for Heaven's
sake... please avoid typing in all caps.</span></br>
                                        <textarea class="textbox" name="service" style="height: 150px;"></textarea>
                                    </td>
                                </tr>
                               <tr>
				<td colspan="2">Add Image:<br />
					<input type="file" name="userfile" class="textbox" />
				</td>
			       </tr>
                                
                            </table>
                        
</div>

<div style="width: 480px; height: auto; float: left;margin-left: 20px;">
                            <table style="width:460px; height:650px;font-family: arial; font-size: 14px; padding: 10px; color: #005c91;">
                                <tr>
                                    <td colspan="2">
                                       <h10>About Act:</h10>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        First Name:</br>
					<input type="text" name="fname" class="textbox" style="width: 200px;"/>
                                    </td>
				    <td>
                                        Last Name:</br>
					<input type="text" name="lname" class="textbox" style="width: 200px;"/>
                                    </td>
                                </tr>
                                <tr>
                                   <td colspan="2">
                                        Your street address:</br>
                                        <input type="text" name="address" class="textbox"/></br>
					<span style="font-size: 12px; color: #bfbfbf;">For verification purposes. Will not be published.</span>
                                    </td>
                                </tr>
                                <tr>
                                   <td colspan="2">
                                        Stage Name:</br>
                                        <input type="text" name="stagenm" class="textbox"/></br>
					<span style="font-size: 12px; color: #bfbfbf;"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Phone:</br>
					<input type="text" name="phone" class="textbox" style="width: 200px;"/></br>
					<span style="font-size: 12px; color: #bfbfbf;">Example: 417-889-9909 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                                    </td>
				    <td>&nbsp;
                                        
                                    </td>
                               </tr>
							
                               <tr>
                                    <td colspan="2">
                                       
					<input type="text" name="a" class="textbox"/></br>
					<span style="font-size: 12px; color: #bfbfbf;">Specifically, how did you hear about us? (optional)</span>
                                    </td>
                                </tr>
			       <tr>
				<td colspan="2">
					<input type="checkbox" name="check"/> &nbsp;
					 I have read and agree to Gig Salad's terms of use.
				</td>
			       </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="submit" name="submit" value="ADD ACT" class="contact" style="border: none;"/>
                                    </td>
                                    
                                </tr>
                            </table>
			      <?php echo form_close(); ?>
			
                        </div>
						</div>
