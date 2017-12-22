<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_email extends CI_Controller 
{

  function __construct()
  {
    parent::__construct();          

    $this->load->model('send_email_model');
  }  
  

 

  public function send_mail()
  {
     $fetch_result=$this->send_email_model->to_sending_email();
     //print_r($fetch_result); exit;
      //$message='';
     $str = "<table border=1>
                  <thead>
                  <th>Inv No</th><th>Officer Name</th><th>Checkin Date</th>
                  </thead>
                  <tbody>";
      foreach ($fetch_result as $res) {
        
        $str .= "<tr><td>".$res['inv_no']."</td><td>".$res['officer_name']."</td><td>".$res['checkin_date']."</td></tr>";
      }
      $str .= "</tbody></table>";

        //print_r($message); exit;
         $from_email = "nirmalizaap@gmail.com"; 
         $to_email = "nirmalizaap@gmail.com"; 
   
         //Load email library
    //      $config = Array(
    //   'protocol' => 'smtp',
    //   'smtp_host' => 'ssl://smtp.googlemail.com',
    //   'smtp_port' => 465,
    //   'smtp_user' => 'nirmalizaap@gmail.com', 
    //   'smtp_pass' => 'passme123!@#', 
    //   'mailtype' => 'html',
    //   'charset' => 'iso-8859-1',
    //   'wordwrap' => TRUE
    // ); 

         $this->load->library('email'); 
         $this->email->from($from_email, 'Testing'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         // $this->email->message($str); 
        echo"<pre>";print_r($str);
         //Send mail 
         // if($this->email->send())
         // {
           
         // } 
         // else
         // {
          
         // } 
      }

  }
  ?>

