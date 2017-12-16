<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Login extends Admin_controller 
{
    protected $_login_validation_rules =array (
                                        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
                                        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
                                      );
     protected $_reset_validation_rules =array (
                                        array('field' => 'npassword', 'label' => 'New Password', 'rules' => 'trim|required|alpha_dash'),
                                        array('field' => 'cpassword', 'label' => 'Confirm Password', 'rules' => 'trim|required|alpha_dash|matches[npassword]')
                                      );
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('login_model');
       
    }  
    public function index()
    {
        if(is_logged_in())
            redirect('home');
        
        $this->login();
    }
    
    public function login()
    {
      $this->form_validation->set_rules($this->_login_validation_rules);       
      if($this->form_validation->run())
      {
          $form = $this->input->post();
          
          if($this->login_model->login($form['email'], $form['password']))
          {
              redirect('home');
          }
          else
          { 
              $this->session->set_flashdata("error_msg","Invalid Username or Password",TRUE);
              redirect('login');
          }
      }        
      $this->layout->view("login/index");        
    }
    
    public function logout()
	  {
	    $this->session->sess_destroy();
	    $this->service_message->set_flash_message('logout_success');
			redirect('home');
	  }

    public function request_password()
    {
      $email = $this->input->post('email');
      $get = $this->login_model->get_where(array("email"=>$email),"*","users")->row_array();
      if($get)
      {
        $send = $this->send_mail($email);
        if($send)
          $this->session->set_flashdata("success_msg","New Password has been sent to your mail id.",TRUE);
        else
          $this->session->set_flashdata("error_msg","Something went wrong in sending mail.",TRUE);
      }
      else
      {
        $this->session->set_flashdata("error_msg","Invalid Email-ID",TRUE);
      }
        redirect("login");
    }
    function send_mail($email)
    {      
      $this->email->from('ramkumar.izaap@gmail.com', 'Ramkumar');
      $this->email->set_mailtype("html");
      $this->email->to($email);
      $this->email->subject('New Password Link');
      $this->data['email'] = base64_encode($email);
      $template = $this->load->view("login/email",$this->data,true);
      $this->email->message($template);
      if($this->email->send())
        return true;
      else
        return false;
    }

    public function reset($email_id='')
    {
      $email = base64_decode($email_id);
      $this->form_validation->set_rules($this->_reset_validation_rules);       
      if($this->form_validation->run())
      {
        $form = $this->input->post();
        $up['password'] = $form['npassword'];
        $ins_id = $this->login_model->update(array("email"=>$email),$up,"users");
        $this->session->set_flashdata("success_msg","Password successfully reset.",TRUE);
        redirect("login");
      }
      $this->data['email'] = $email_id;
      $this->data['editdata'] = array("npassword"=>"","cpassword"=>"");
      $this->layout->view("/login/reset");
    }
    
}

?>