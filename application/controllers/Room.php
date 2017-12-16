<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/Admin_controller.php");
class Room extends Admin_Controller {

	protected $_room_validation_rules = array (
                                        array('field' => 'name', 'label' => 'Room Name', 'rules' => 'trim|required'),
                                        array('field' => 'tariff', 'label' => 'Tariff', 'rules' => 'trim|required|numeric'),
                                        array('field' => 'type', 'label' => 'Room Type', 'rules' => 'trim|required'));

	function __construct()
  {
    parent::__construct();
    $this->load->model('room_model');
    if(!is_logged_in())
          redirect("home");
  }  
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function status()
	{
		$this->layout->set_title("Room Status");
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('');
    $this->_narrow_search_conditions = array("po_no","officer_name","checkout_date_from","checkout_date_to","inv_no","invoice_link","status","pdf_downloaded");
    // $str = '<a href="'.site_url('booking/create/{id}').'" class="table-action"><i class="fa fa-edit edit"></i> Edit</a>';
    // $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('room_model', 'listing');
    if($this->input->is_ajax_request())
        $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = '';//$this->load->view('frontend/roombooking/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
		$this->layout->view('/frontend/room/status');
	}
	public function create()
	{
		$this->layout->set_title("Create Room");
		$this->form_validation->set_rules($this->_room_validation_rules);       
    if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$ins['name'] = $form['name'];
    	$ins['tariff'] = $form['tariff'];
    	$ins['type'] = $form['type'];
    	$ins['created_date'] = date("Y-m-d H:i:s");
    	$ins_id = $this->room_model->insert($ins);
    	if($ins_id)
    		$this->session->set_flashdata("success_msg","Room created successfully",TRUE);
    	else
    		$this->session->set_flashdata("error_msg","Room not created.",TRUE);
    	redirect("room/status");
    }
		$this->layout->view('/frontend/room/create');
	}
}
