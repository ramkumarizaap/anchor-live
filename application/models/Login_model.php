<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Login_model extends App_model
{
   protected $table = "";
   
   function __construct()
   {
     parent::__construct();
   }

   public function login($email, $password)
   {

      $pass = md5($password);
     
      $this->db->select('id,email,password,role');
      $this->db->from('users');
      $this->db->where('email', $email);
      $this->db->where('password', $password);

      $user = $this->db->get()->row_array();

      if(count($user)>0)
      {      
        $this->session->set_userdata('user_data', $user);
        
        return true;
      }
      
      return false;
   }
   
   public function logout()
   {
        $this->session->sess_destroy();

        redirect('login');
   }
    
}

?>