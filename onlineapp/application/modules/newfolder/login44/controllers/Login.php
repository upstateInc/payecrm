<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form','url');
		$this->load->driver('session');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'doc|docx|pdf|txt|jpg';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        $this->load->database();
		$this->load->library('upload', $config);
		$this->load->library(array('email','session'));
		$this->load->model(array('Common_model'));
		
	}

	public function index()
	{
		
		
		  $this->load->view("logintemplate/header");		  
		   $this->load->view("login");
		 $this->load->view("logintemplate/footer");
		  
		  

	}
	public function forgot_password()
	{
		
	$this->load->view("logintemplate/header");		  
		   $this->load->view("forgot");
		  $this->load->view("logintemplate/footer");	
		
		
	}
	
	
	public function reset_password()
	{
	$tmp=$_GET['resetid'];
	$em=base64_decode($tmp);
	$this->session->set_userdata('email',$em);	
	$this->load->view("logintemplate/header");		  
		   $this->load->view("resetpassword");
		  $this->load->view("logintemplate/footer");	
		
		
	}
	
	
	
	function logout()
	{
	  $this->session->sess_destroy();
	   redirect(base_url().'login');
	}
	
	
	
	public function login_check(){
	$uname=$_POST['user_name'];
		$passwd=$_POST['user_pass'];
	$query=$this->db->get_where('user',array('email'=>$uname,'password'=>$passwd));
		$res=$query->result_array();
		$no=$query->num_rows();  
	if($no>=1)
	 {
		$sid=$res[0]['id'];	
		 $sessarr=array('id'=>$res[0]['id'],'email'=>$res[0]['email'],'name'=>$res[0]['name'],'loggedInEmail'=>$res[0]['loggedInEmail']);
		 $this->session->set_userdata($sessarr);
			
		 redirect("pmt-form/business?signupid=$sid");
	 }
		 $this->session->set_flashdata('wrongcred','<center><font color="#d61919">Enter Proper Details!</font></center>');
		redirect('/login/');
		
	}
	
	
	
	
	public function vemail()
	{
		
		
		$uemail=$_POST["user_name"];
		$query=$this->db->get_where('user',array("email" =>$uemail));
		$no=$query->num_rows();  
		if($no>=1)
		{
			$query=$this->db->get_where('user',array("email" =>$uemail));
			$res=$query->result_array();
			$em=$res[0]['email'];
			$rid=base64_encode($em);
			$pid=$res[0]['password'];
			$config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
                        $config['smtp_port'] = 465;
			$config['smtp_user']="payehubsupport@payehub.com";
			$config['smtp_pass']="@payehubsupport";
			$this->load->library('email',$config);
			$this->email->set_mailtype('html');
			$this->email->set_newline("\r\n");
			$this->email->from('payehubsupport@payehub.com','payehub');
			$this->email->to($uemail);
			$this->email->subject('Password Reset Link');
			$this->email->message("<a href='".base_url()."login/reset-password?resetid=$rid'>Go to reset your password!</a>");
			$this->email->send();
			
			$this->session->set_userdata('email',$uemail);
			$this->session->set_flashdata('lostpwd',"<a href='https://mail.google.com/mail/u/0/#inbox'><font color='#7eb63b'>Go to your mail box..</font></a>");
		redirect(base_url().'login/forgot-password');
		}
		else
		{
			$this->session->set_flashdata('emailnotfound',1);
			redirect(base_url().'login/forgot-password');
			
		}
		
		
	}
	
	
	
	//readcountry
	
	public function readCountry()
	{
if(!empty($_POST["inputSuccess1"])) {
	
	$match=$_POST["inputSuccess1"];
	
	$this->db->like('title',$match); 
    $rr=$this->db->get('t_jobs',10,0);
    $no=$this->db->count_all_results();
    $res=$rr->result_array();
//$row=mysql_fetch_array($result);
if($no!=0) {

echo '<ul id="country-list">';

foreach($res as $row) {	
?>
<li style=" width:100%;" onClick="selectCountry('<?php echo $row["title"]; ?>');"><?php echo $row["title"]; ?></li>
<?php } 
echo "</ul>";

 } 
 
 } 
	}
	
	
	
	
	
	
	
	
	
	
	
	//readCountry
	
	public function  resetpassword()
	{
		
		$email=$this->session->userdata('email');
		$pwd=$this->input->post('user_pass');
		//echo $pwd;
		$userdata=array('password'=>$pwd);
		$this->Common_model->updwhere('user',array('email'=>$email),$userdata);
		$retval=$this->Common_model->collectAll('user',$email);
		$sid=$retval[0]['id'];
		   $data['email']=$retval[0]['email'];
		   $data['password']=$retval[0]['password'];
		    $data['name']=$retval[0]['name'];
		     $data['loggedInEmail']=$retval[0]['loggedInEmail'];
		    
			$this->session->set_userdata($data);
			redirect(base_url()."pmt-form/business?signupid=$sid");
	}
	


		
	
	public function uploadprofileimg()
	{
		
		$this->load->library('upload', $config);
	    $this->upload->do_upload('file1');
		$res=$this->upload->data();
		 $filename=$res['file_name'];
	
		 $email=$_SESSION['loggedInEmail'];
   
     $data=array('profile_pic'=>$filename);
	 
	 $this->db->where(array('email'=>$email));
     $this->db->update('t_user_login',$data);
	 redirect(base_url().'login/login/dashboard#upld');
	}
	
	
	
	
	/*public function savetodb()
	{
		
		$upl=$this->input->post('file1');
		$email=$this->input->post('email');
		$pass=$this->input->post('pwd');
		$data=array('resume'=>$upl,'email'=>$email,'passwd'=>$pass);
		$qry=$this->db->insert('uploadresume',$data);
		redirect("upload_resume");
		
	}*/
	
	
    public function newreg()
   {
    if(isset($_POST['pwd']))
     {
     
	   

		$this->upload->do_upload('file1');
		
		
		
		
	
     $email=$_POST['eml'];
     $pass=$_POST['pwd'];
     $data=array('email'=>$email,'password'=>$pass);
     $this->db->insert('t_user_login',$data);
     }
   else
    {
	redirect('./');
    }
}

	
	
	
	
	
	public function createAlert(){
		
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$mobno=$_POST['mobno'];
		$skill=$_POST['skill'];
		$data=array('fname'=>$fname,'lname'=>$lname,'email'=>$email,'mobno'=>$mobno,'skill'=>$skill);
		
		$this->db->insert('alert',$data);
		
		
		    $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_port'] = 465;
			$config['smtp_user']="menotforxhat@gmail.com";
			$config['smtp_pass']="rememberpw";
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			
			$this->email->from('menotforxhat@gmail.com', 'Ashutosh Kumar');
			$this->email->to($email);
			$this->email->subject('Alert');
			$this->email->message("Hi your job alert has been created at site Techejobs ASAP visit <a href='".base_url()."'>Techejobs Site</a>");
			$this->email->send();
		
		
		
		
		
		
		
	
	}
	
	
	
	
	
	
	
	public function createMessage(){
		
		$title=$_POST['title'];
		
		$email=$_POST['toemail'];
		
		$msg=$_POST['msg'];
	
		    $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_port'] = 465;
			$config['smtp_user']="menotforxhat@gmail.com";
			$config['smtp_pass']="rememberpw";
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			
			$this->email->from('menotforxhat@gmail.com', 'Ashutosh Kumar');
			$this->email->to($email);
			$this->email->subject('Message regarding $title');
			$this->email->message($msg);
			$this->email->send();
		
		
		
		
		
		
		
	
	}
	
	
	
	
	
	
	
	
public function chkusr()
        {
		
		$uname=$_POST['uname'];
		$passwd=md5($_POST['pass']);
		
		$query=$this->db->get_where('t_user_login', array('email' =>$uname,'password'=>$passwd));
		$no=$query->num_rows();  
		if($no>=1)
		{
			
			$sessarr=array('loggedIn'=>'Ashutosh','loggedInEmail'=>$uname);
			$this->session->set_userdata($sessarr);
			
			
			
		}
		else
		{
			?>
          Invalid Username Or Password!...  
            <?php
			
		}
		
		
		
      
}
	





	
public function dashboard()
	{
		
		$_SESSION['skey']="";	
		
		 $email=$_SESSION['loggedInEmail'];		 
		 $this->db->select("*");
		$this->db->from("t_user_login");
		$this->db->where(array("email"=>$email));
		$query=$this->db->get();
		$resultdata['resultarray']=$query->result_array();
		
		$this->load->view("template/header",$resultdata);
		 $this->load->view("template/left-menu");
		 
		 //$this->load->model('dashboard_model');
		 
		 //$resultdata['resultarray']=$this->dashboard_model->show();
		$this->db->select("*");
		$this->db->from("t_ziptbl");
		
		$query222=$this->db->get();
		$resultdata['zipcode']=$query222->result_array();
		
		
		
		$this->db->select("*");
		$this->db->from("t_country");
		
		$query333=$this->db->get();
		$resultdata['countrynm']=$query333->result_array();
		
		
		
		
		$this->db->select("*");
		$this->db->from("t_city");
		
		$query444=$this->db->get();
		$resultdata['citynm']=$query444->result_array();
		
		
		
		
		$this->db->select("*");
		$this->db->from("t_jobClassification");
		$query555=$this->db->get();
		$resultdata['jobcat']=$query555->result_array();
		
		
		 
		 $this->load->view("jobseeker",$resultdata);
		 
		
		  $this->load->view("template/footer");
		
	}
	
	
	
	
	
	
	
	
	
	
	
	public function rpass()
	{
		if(!isset($_SESSION['loggedInEmail']))
		{
		
		$uemail=$_SESSION["eid"];
		$pid=$_SESSION["pid"];
		
		$upass=md5($_POST["pass1"]);
		$data=array('password'=>$upass);
		
		$query=$this->db->where("email",$uemail);		
		$query=$this->db->where("password",$pid);
		
		
		
		$query=$this->db->update('t_user_login',$data);
		 $no=$this->db->affected_rows();
		 
		}
		else
		{	
		$uemail=$_SESSION['loggedInEmail'];
		$upass=md5($_POST["pass1"]);
		$data=array('password'=>$upass);
		$query=$this->db->where("email",$uemail);		
	     $query=$this->db->update('t_user_login',$data);
		 $no=$this->db->affected_rows();
			
		}
		
	
		 
		if($no!=0)
		{
			
           $config['protocol'] = 'smtp';
           $config['smtp_host'] = 'ssl://smtp.googlemail.com';
           $config['smtp_port'] = 465;
			$config['smtp_user']="menotforxhat@gmail.com";
			$config['smtp_pass']="rememberpw";
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");			
			$this->email->from('menotforxhat@gmail.com', 'Ashutosh Kumar');
			$this->email->to($uemail);
			$this->email->subject('Password changed!');
			$this->email->message('Your password has been changed successfully !...');
			$this->email->send();
			
      
		}
		else
		{
	
			?>
            Email Not Found..
            <?php
			
		}
		
		
	}
	
	
	
	
	
	
public function save()
	{
		$email=$_SESSION['loggedInEmail'];
		$fname=$this->input->post('fname');
		$lname=$this->input->post('lname');
		$phone=$this->input->post('phone');
		$secondaryPhone=$this->input->post('contact');
		
		$street=$this->input->post('street');
		$country=$this->input->post('country');
		$zip2=$this->input->post('zip2');
		$zip1=$this->input->post('zip1');
		
		
		$city=$this->input->post('city');
		
		$state=$this->input->post('state');	
		
		
		if($country=='United States' && $zip1!="")
		{
		 $zip=$zip1;	
		 $city="";
		 $state="";
		}
		else if($zip2=="")
		{
			$zip=$zip1;
		}
		else
		{
			$zip=$zip2;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$address=$street.",".$zip.",".$country;
		
		
		$jobClassification=$this->input->post('jobcat');
		
		$employment=$this->input->post('positionType[]');
		
		
		
		
		foreach($employment as $emp)
		{
			
			if($emp!="" && $empl!="" )
			{
				$empl=$empl.",".$emp;
			}
			else if($emp!="" && $empl=="" )
			{
				$empl=$emp;
			}
		}
		
		
		
		
		
		
		
		$desiredJobTitle=$this->input->post('jobtitle');
		$education=$this->input->post('education');
		
		$tmp1=$this->input->post('certification');
		
		$tmp2=$this->input->post('text');
		
		foreach($tmp2 as $cert)
		{
			if($cert!="" && $certk!="" )
			{
				$certk=$certk.",".$cert;
			}
			else if($cert!="" && $certk=="" )
			{
				$certk=$cert;
			}
		}
		if($tmp2!=""){
		$certification=$tmp1.",".$certk;
		}
		else
		{
			$certification=$tmp1;
		}
		
		$skills=$this->input->post('skills');
		
		
		
		
		
		
		
		$exp=$this->input->post('exp');
		$relocate=$this->input->post('relocate');
		
		
		$prefloc=$this->input->post('right_select[]');
		
		foreach($prefloc as $ploc)
		{
			if($ploc!="" && $plok!="" )
			{
				$plok=$plok.",".$ploc;
			}
			else if($ploc!="" && $plok=="" )
			{
				$plok=$ploc;
			}
		}
		
		
		$authorization=$this->input->post('authorization');
		
		
		$rate=$this->input->post('rate');
		$expected_salary=$this->input->post('expected_salary');
		
		
		
		
		if($plok!="" || $relocate=='N')
		{
			
			
			
		
		
		$data=array('fname'=>$fname,'city'=>$city,'state'=>$state,'lname'=>$lname,'address'=>$address,'zip'=>$zip,'phone'=>$phone,'jobClassificationId'=>$jobcat,'experience'=>$exp,'preferredRelocations'=>$plok,'skills'=>$itskill,'relocate'=>$relocate,'secondaryPhone'=>$secondaryPhone,'authorization'=>$authorization,'desiredJobTitle'=>$desiredJobTitle,'jobClassification'=>$jobClassification,'education'=>$education,'employment'=>$empl,'certification'=>$certification,'skills'=>$skills,'country'=>$country,'rate'=>$rate,'expected_salary'=>$expected_salary);
		
		$this->db->where(array('email'=>$email));
		$this->db->update('t_user_login',$data);
		
		}
		else
		{
			
			$data=array('fname'=>$fname,'city'=>$city,'state'=>$state,'lname'=>$lname,'address'=>$address,'zip'=>$zip,'phone'=>$phone,'jobClassificationId'=>$jobcat,'experience'=>$exp,'skills'=>$itskill,'relocate'=>$relocate,'secondaryPhone'=>$secondaryPhone,'authorization'=>$authorization,'desiredJobTitle'=>$desiredJobTitle,'jobClassification'=>$jobClassification,'education'=>$education,'employment'=>$empl,'certification'=>$certification,'skills'=>$skills,'country'=>$country,'rate'=>$rate,'expected_salary'=>$expected_salary);
		
		$this->db->where(array('email'=>$email));
		$this->db->update('t_user_login',$data);
			
		}
		
		
		
		
		
		
		
		
		
		
		redirect("login/login/dashboard?save=1");
		
	}
	
	
	
	
	
	
 public function search()
 {
	 
	if (isset($_GET['term'])){
	$trm=$_GET['term'];
	$return_arr = array();
$this->db->like('title',$trm);
$qry=$this->db->get("t_jobs",10,0);
$res=$qry->result_array();

	    foreach($res as $resarray) {
	        $return_arr[] =  $resarray['title'];
	  
	}

    echo json_encode($return_arr);
}

 
	 
  }
	
	
	
	
	
	
}
