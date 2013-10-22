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

/************************************* Create an instance of the addregistration model ************************************/

$this->load->model('Addreg');

/******************************************* if submit is isset then process function is called from addreg model *******************************************/

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
 
 
 /*********************************** process function end ********************************************/
 
 /*********************************** redirect the page to userlogin index page ***********************/
redirect('userlogin'); 
    
    
	
	}
	
/**************************************  End *****************************************/
	
/**************************************  User login controller ****************************************/		
	
	public function userlog(){
	
        // Load the model
        $this->load->model('userlogin_model');
        // Validate the user can login
        $result = $this->userlogin_model->validate();
		
		
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            //$this->index();
			 
			echo "Invalid username/password";
        }else{
            // If user did validate, 
            // Send them to members area
        //redirect('home');
		 foreach($result as $row)
     {
       $sess_array = array(
         
         'username' => $row->username,
		 'type'=>$row->type,
		 'email'=>$row->email,
		  'pass'=>$row->pwd
       );
	   $_SESSION['data']=$sess_array;
	  
	   }
	  
       
	   
		redirect('userlogin/chklogin');
        }    
		    
    }
/************************************* end *********************************************/



/**************************************** check login and redirect tpo corresponding user page   **************************************/

function chklogin()
{
if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['type'];

if($x==2)
{

$this->template->load('usertemplate', 'actmanager/actmanager_homepage',$data); 

}
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


/*****************************  Act manager Agency Change******************************/


function agencychange()
{
if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['email'];

}
	$data['emailvalue']=$x;

$this->load->model('allacts','',TRUE);
$data['allacts'] = $this->allacts->allactdetails($x);

$this->template->load('usertemplate', 'actmanager/agencychange',$data);

}


/**************************************** end   ***************************************/


/*****************************  Act manager Vedio add******************************/


function addvedio()
{
if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['email'];

}
$data['emailvalue']=$x;
$this->template->load('usertemplate', 'actmanager/addvedio',$data);

}



/**************************************** end   ***************************************/


/***************************** edit Act manager profile ******************************/

function editprofile()
	{
	
	if($_SESSION['data'])
{
$data=$_SESSION['data'];

	}

	$this->template->load('usertemplate', 'actmanager/editprofile',$data);

	
	}
	
/**************************************** end *********************************************/	


/*****************************  Act manager password change ******************************/	
	
function change_password()
	{
	    if($_SESSION['data'])
{
$data=$_SESSION['data'];

	}
	$this->template->load('usertemplate', 'actmanager/cpassword',$data);
	}
	
function cpassword()
	{
	
	$this->load->model('cpassword');
$email = $this->input->post('email');
$pass = $this->input->post('pass');
$cpass = $this->input->post('cpass');
$data['value']=$this->cpassword->cpassw($email,$pass,$cpass);

	
	}


/***************************** end ******************************/
	
	
	
/*****************************  Act manager Diary ******************************/


function diary()
{
if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['email'];

}
$data['emailvalue']=$x;

$this->template->load('usertemplate', 'actmanager/diary',$data);
}

/**************************************** end   ***************************************/


	
/***************************** Add Act manager Details******************************/
function addactmanager()
	{
	
	if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['email'];

}
	$this->load->model('event','',TRUE);
	$data['events'] = $this->event->events(); 
	$this->load->model('skill','',TRUE);
	$data['skills'] = $this->skill->skills();
	 $this->load->model('eventmanager','',TRUE);
	$data['locations'] = $this->eventmanager->locations();
	$data['emailvalue']=$x;
	$this->template->load('usertemplate1', 'eventmanager/addactmanager',$data); 
	 
	
	}
	
/**************************************** end   ***************************************/


/***************************** View all Act manager Details assigned to the login eventmanaget******************************/
	
	function viewact()
	{
	if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['email'];

}
	$dataval['emailvalue']=$x;
	$this->load->model('act','',TRUE);
$data['allacts'] = $this->act->allact($dataval);


	$this->template->load('usertemplate1', 'eventmanager/viewact',$data); 
	
	
	}



/**************************************** end   ***************************************/



/****************************************  view all event notyificaton of event manager   ***************************************/
	
	
	function eventnotification()
	{
	if($_SESSION['data'])
{
$data=$_SESSION['data'];
$x=$data['email'];

}
	$data['emailvalue']=$x;
$this->template->load('usertemplate1', 'eventmanager/eventnotification',$data);
	
	
	
	}
	
/****************************************   end   ****************************************************/	


/****************************************  event  manager change password   ***************************************/
	
function changepassword()
	{
	    if($_SESSION['data'])
{
$data=$_SESSION['data'];

	}
	$this->template->load('usertemplate1', 'eventmanager/cpassword1',$data);
	}
	
function cpassword1()
	{
	
	$this->load->model('cpassword1');
$email = $this->input->post('email');
$pass = $this->input->post('pass');
$cpass = $this->input->post('cpass');
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
 if(session_destroy())
{
 redirect('userlogin/index', 'refresh');
}
else
{
echo "session exist";
}
}

/******************************************************* End ***************************************/

	
	
	}
	?>
