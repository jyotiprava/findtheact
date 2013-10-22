<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
  session_start();
class Userlogin extends CI_controller{


    
 /********************* load userlogin and signup page ***********************/ 

    public function index(){
       
      $this->load->view('user/userhomepage');
      
    }
    
 /*****************************   End   *************************/  
 
 /***********************  Save new user details/sign up form details    ***************************************/  
    
	function save()
{

// Create an instance of the addreg model

$this->load->model('Addreg');

//if submit is isset then call the process function of addreg model

if($this->input->post('submit'))
{


$this->Addreg->process();
//   --------Email conformation-----------//
/*$confirm_code=md5(uniqid(rand()));
$email = $this->input->post('email');

$config['wordwrap'] = TRUE;
    $this->email->initialize($config);
 $this->email->from('noreply@gmail.com');
 $this->email->to($email);
    $this->email->subject('Your confirmation link here');
    $this->email->message('Thanks for signing with us. Kindly click on the link below to activate your account\n\n
<a href='.site_url('user/verify').'?passkey='.$confirm_code.'>Click Here</a>'); 
    
 $this->email->send();

     */           
	 
	 
	 //-------------Email send ends---------------//
 }
 
// redirect to the userlogin view
redirect('userlogin'); 
    
    
	
	}
	
/**************************************  End *****************************************/
	
/**************************************  User login controller ****************************************/		
	
	public function userlog(){
	
        // Create an instance of the userlogin model
        $this->load->model('userlogin_model');
        // Validate the user can login
        $result = $this->userlogin_model->validate();
		
		
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show an error message
           
			 
			echo "Invalid username/password";
        }else{
            // If user did validate,then foreach result 
            
		 foreach($result as $row)
     {
     	//store username,type,email and password store in an  $sess_array
       $sess_array = array(
         
         'username' => $row->username,
		 'type'=>$row->type,
		 'email'=>$row->email,
		  'pass'=>$row->pwd
       );
       
     
     // store $sess_array data in sesssion
	   $_SESSION['data']=$sess_array;
	  
	   }
	  
       //then redirect to checklogin function of userlogin controller 
	   
		redirect('userlogin/chklogin');
        }    
		    
    }
/************************************* end *********************************************/



/**************************************** check login and redirect to corresponding user page   **************************************/

function chklogin()
{

//if session data is not null 	
if($_SESSION['data'])
{
//assign the session data in a variable $data
$data=$_SESSION['data'];
//get the type of login user from session data
$x=$data['type'];
//if user type=2 then act person login
//if user type=1 then act agency login
//if login user type is 2 then load the actperson home view page
if($x==2)
{

$this->template->load('usertemplate', 'actmanager/actmanager_homepage',$data); 

}
//else load act agency home view page
else
{

$this->template->load('usertemplate1', 'eventmanager/eventmanager_homepage',$data); 
}
}

}




/****************************************************   end   ***********************************************************/



function addact()
	{
	$this->load->model('event','',TRUE);
	$data['events'] = $this->event->events();
	
	$this->load->model('skill','',TRUE);
	$data['skills'] = $this->skill->skills();
	$this->template->load('usertemplate', 'actmanager/addact',$data); 
	 //$this->template->load('usertemplate', 'actmanager/addact',$data); 
	
	}


/*****************************  Act person Change act agency ******************************/


function agencychange()
{
//if session data is isset
if($_SESSION['data'])
{
//store session data in a variable data
$data=$_SESSION['data'];
//get the login user emailid from data variable and store in a variable x
$x=$data['email'];

}
//store the email value in eamilvalue

	$data['emailvalue']=$x;
//create the instance of the allactagency model

$this->load->model('allacts','',TRUE);
//call the allactdetails function from allacts model by passing the login user email
// then store all the actagency details in allacts variable

$data['allacts'] = $this->allacts->allactdetails($x);

//load the agency change view page  by passing the variable $data

$this->template->load('usertemplate', 'actmanager/agencychange',$data);

}


/**************************************** end   ***************************************/


/*****************************  Act manager Vedio add******************************/


function addvedio()
{
	//if session data is isset
if($_SESSION['data'])
{
	//store session data in a variable data
$data=$_SESSION['data'];
//store the email value in variable $x
$x=$data['email'];

}
//store the email value in eamilvalue
$data['emailvalue']=$x;
//load add vedio view page by passing all the data array
$this->template->load('usertemplate', 'actmanager/addvedio',$data);

}



/**************************************** end   ***************************************/


/***************************** edit Act manager profile ******************************/

function editprofile()
	{
	//if session data is set then store it in a variable 
	if($_SESSION['data'])
{
$data=$_SESSION['data'];

	}
	//load the act person editprofile view page by passing the data array 

	$this->template->load('usertemplate', 'actmanager/editprofile',$data);

	
	}
	
/**************************************** end *********************************************/	


/*****************************  Act manager password change ******************************/	
	
function change_password()
	{
		//if session is set
	    if($_SESSION['data'])
{
	//store session data in data variable
$data=$_SESSION['data'];

	}
	//load act person changepassword view page
	$this->template->load('usertemplate', 'actmanager/cpassword',$data);
	}
	
function cpassword()
	{
//get the instance of the change password model
	
	$this->load->model('cpassword');
	
//Grab the email and new password and confirm password from the form POST
$email = $this->input->post('email');
$pass = $this->input->post('pass');
$cpass = $this->input->post('cpass');
//call the cpassw function from change password model to change the existing password
$data['value']=$this->cpassword->cpassw($email,$pass,$cpass);

	
	}


/***************************** end ******************************/
	
	
	
/*****************************  Act manager Diary ******************************/


function diary()
{
	//if session is isset then store the session data in a variable
if($_SESSION['data'])
{
$data=$_SESSION['data'];
//store the session email value in a variable x
$x=$data['email'];

}
$data['emailvalue']=$x;

//load the act person diary view page by passing all the data in data array

$this->template->load('usertemplate', 'actmanager/diary',$data);
}

/**************************************** end   ***************************************/


	
/***************************** Add Act person Details******************************/
function addactmanager()
	{
		//if isset session data then store it in a variable called $data
	
	if($_SESSION['data'])
{
$data=$_SESSION['data'];
//get the login user email value from the data
$x=$data['email'];

}
//create the instance of the event model and store all the event details in events array
	$this->load->model('event','',TRUE);
	$data['events'] = $this->event->events(); 
//create the instance of the skill model and store all the skills in skills array
	$this->load->model('skill','',TRUE);
	$data['skills'] = $this->skill->skills();
//create the instance of the eventmanager model and store all the location details  of all the act persons in location array
	 $this->load->model('eventmanager','',TRUE);
	$data['locations'] = $this->eventmanager->locations();
	$data['emailvalue']=$x;
//load the add act erson view page by passing all the data stored in $data array
	$this->template->load('usertemplate1', 'eventmanager/addactmanager',$data); 
	 
	
	}
	
/**************************************** end   ***************************************/


/***************************** View all Act manager Details assigned to the login eventmanaget******************************/
	
	function viewact()
	{
//if isset session then store the session value in a variable
	if($_SESSION['data'])
{
$data=$_SESSION['data'];
//get the email value from the data
$x=$data['email'];

}
	$dataval['emailvalue']=$x;
//create an instance of the act model
	$this->load->model('act','',TRUE);
$data['allacts'] = $this->act->allact($dataval);

//load view all act deatils view page
	$this->template->load('usertemplate1', 'eventmanager/viewact',$data); 
	
	
	}



/**************************************** end   ***************************************/



/****************************************  view all event notyificaton of act person   ***************************************/
	
	
	function eventnotification()
	{
		//if session is isset
	if($_SESSION['data'])
{
	//store the sesion data in a variable named as data
$data=$_SESSION['data'];
//get the user email from session
$x=$data['email'];

}
	$data['emailvalue']=$x;
//load the eventnotification view page
$this->template->load('usertemplate1', 'eventmanager/eventnotification',$data);
	
	
	
	}
	
/****************************************   end   ****************************************************/	


/****************************************  act agency  change password   ***************************************/
	
function changepassword()
	{
//if session is isset then store the session value in a variable $data
	    if($_SESSION['data'])
{
$data=$_SESSION['data'];

	}
//load act agency change password view page
	$this->template->load('usertemplate1', 'eventmanager/cpassword1',$data);
	}
	
function cpassword1()
	{
 // Create an instance of the acgency change password model
	$this->load->model('cpassword1');
 // Grab the email and password from the form POST
$email = $this->input->post('email');
$pass = $this->input->post('pass');
$cpass = $this->input->post('cpass');
//call the cpassw function of change password model
$data['value']=$this->cpassword1->cpassw($email,$pass,$cpass);

	
	}
	
	
/****************************************   end   ****************************************************/	



function notification()
{
	if($_SESSION['data'])
	{
	$data=$_SESSION['data'];
	$x=$data['type'];
		if($x==2)
		{
		$this->load->model('notedetails');

		$data1['results'] = $this->notedetails->subcategory($data);
		$this->template->load('usertemplate', 'actmanager/notification',$data1);
		}
	}
}


/******************************************************* logout ***************************************/

function logout()

	{
//if session ll destroy then reditect the page to userlogin page
 if(session_destroy())
{
 redirect('userlogin/index', 'refresh');
}
//else giving an session exist message
else
{
echo "session exist";
}
}

/******************************************************* End ***************************************/

	
	
	}
	?>
