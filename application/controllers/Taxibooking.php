<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Taxibooking extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();          
        $this->load->model('org_model');
       
    }  

    public function index(){

        $this->layout->view('frontend/taxibooking/index');
    }

    
}
?>
