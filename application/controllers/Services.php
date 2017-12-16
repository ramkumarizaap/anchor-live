<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



require_once(APPPATH."libraries/Admin_controller.php");



class Services extends Admin_Controller 

{

  function __construct()

  {

      parent::__construct();          

      $this->load->model('services_model');

      if(!is_logged_in())

        redirect("home");

  }



  public function index()

  {

  	redirect("services/executives");

  }



  public function executives()

  {

  	$this->layout->set_title('Manage Executives');

  	$this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');



  	/* Executives Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal" data-id="{id}" data-table="executives" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/executives\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'executives');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/frontend/services/executives');

  }



  public function rooms()

  {

  	$this->layout->set_title('Manage Rooms');

  	$this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');

  	/*Rooms Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal3" data-id="{id}" data-table="rooms" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/rooms\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'rooms');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

	 	$this->layout->view('/frontend/services/rooms');

  }

  public function rank()

  {

  	$this->layout->set_title('Manage Rank');

  	$this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');

  	/*Rank Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal1" data-id="{id}" data-table="rank" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/rank\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'rank');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);	

    $this->layout->view('/frontend/services/rank');

  }



  public function vessels()

  {

  	$this->layout->set_title('Manage Vessels');

  	$this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');

    /*Vessels Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal2" data-id="{id}" data-table="vessels" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/vessels\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'vessels');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/frontend/services/vessels');

  }



  public function inv_address()

  {

  	$this->layout->set_title('Manage Inv Address');

  	$this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');

    /*Vessels Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal" data-id="{id}" data-table="invoice_address" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/inv_address\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'inv_address');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/frontend/services/inv_address');

  }



  public function purpose()

  {

  	$this->layout->set_title('Manage Purpose');

  	$this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');

    /*Vessels Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal" data-id="{id}" data-table="purpose" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/purpose\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'purpose');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/frontend/services/purpose');

  }



  public function cost_centre()

  {

    $this->layout->set_title('Manage Purpose');

    $this->layout->add_javascripts(array('listing'));

    $this->load->library('listing');

    /*Vessels Grid*/

    $this->simple_search_fields = array('');

    $this->_narrow_search_conditions = array("");

    $str = '<a href="#" data-remodal-target="modal" data-id="{id}" data-table="cost_centre" onclick="get_services(this)" class="table-action"><i class="fa fa-edit edit"></i> Edit</a><br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'services/delete/{id}/cost_centre\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';

    $this->listing->initialize(array('listing_action' => $str));

    $listing = $this->listing->get_listings('services_model', 'cost_centre');

    if($this->input->is_ajax_request())

        $this->_ajax_output(array('listing' => $listing), TRUE);

    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

    $this->data['simple_search_fields'] = $this->simple_search_fields;

    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

    $this->data['per_page'] = $this->listing->_get_per_page();

    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

    $this->data['search_bar'] = "";

    $this->data['listing'] = $listing;

    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

    $this->layout->view('/frontend/services/cost_centre');

  }



  public function add_services()

  {

    $action = $this->input->post('action');

    if($action=="rooms")

      $ins['tariff'] = $this->input->post('tariff');

    if($action=="invoice_address")

      $ins['address'] = $this->input->post('name');

    else

      $ins['name'] = $this->input->post('name');

    $ins['status'] = $this->input->post('status');

    $id = $this->input->post('id');

  	if($id!='')

  	{

  		$ins_id = $this->services_model->update(array("id"=>$id),$ins,$action);

  		$act = "updated";

  	}

  	else

  	{

  		$ins_id = $this->services_model->insert($ins,$action);

  		$act = "added";

  	}

  	if($ins_id)

  	{

  		$output['status'] = "green";

  		$output['msg'] = "Record $act successfully";

  	}

  	else

  	{

  		$output['status'] = "red";

  		$output['msg'] = "Something wrong.";	

  	}

  	$this->_ajax_output($output,TRUE);

  }

  public function get_services()

  {

  	$id = $this->input->post('id');

  	$table = $this->input->post('table');

  	$r = $this->services_model->get_services(array("id"=>$id),$table);

  	$this->_ajax_output($r,TRUE);

  }
  function delete($del_id,$table='')
  {
    $access_data = $this->services_model->get_where(array("id"=>$del_id),'id',$table)->row_array();     
    $output=array();
    if(count($access_data) > 0)
    {
      $this->services_model->delete(array("id"=>$del_id),$table);
      $output['message'] ="Record deleted successfuly.";
      $output['status']  = "success";
    }
    else
    {
      $output['message'] ="Can't able to deletes.";
      $output['status']  = "error";
    }      
    $this->_ajax_output($output, TRUE);            
  }



}

?>