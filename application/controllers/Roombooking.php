<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



require_once(APPPATH."libraries/Admin_controller.php");



class Roombooking extends Admin_Controller 

{

	protected $_booking_validation_rules = array (

                                        array('field' => 'po_no', 'label' => 'Purchase Order No', 'rules' => 'trim|required'),

                                        array('field' => 'officer_name', 'label' => 'Officer Name', 'rules' => 'trim|required'),

                                        array('field' => 'rank', 'label' => 'Rank', 'rules' => 'trim|required'),

                                        array('field' => 'executive', 'label' => 'Booking Executive', 'rules' => 'trim|required'),

                                        array('field' => 'occupancy', 'label' => 'Occupancy', 'rules' => 'trim|required'),

                                        array('field' => 'room_name', 'label' => 'Room Name', 'rules' => 'trim|required'),

                                        array('field' => 'purpose', 'label' => 'Purpose of Visit', 'rules' => 'trim|required'),

                                        array('field' => 'vessel', 'label' => 'Assigned Vessel', 'rules' => 'trim|required'),

                                        array('field' => 'course_name', 'label' => 'Course Name', 'rules' => 'trim|required'),

                                        array('field' => 'checkin_date', 'label' => 'Checkin Date', 'rules' => 'trim|required'),

                                        array('field' => 'checkin_time', 'label' => 'Checkin Time', 'rules' => 'trim|required'),

                                        array('field' => 'checkout_date', 'label' => 'Checkout Date', 'rules' => 'trim|required'),

                                        array('field' => 'checkout_time', 'label' => 'Checkout Time', 'rules' => 'trim|required'),

                                        //array('field' => 'breakfast', 'label' => 'Breakfast', 'rules' => 'trim|required'),

                                        //array('field' => 'lunch', 'label' => 'Lunch', 'rules' => 'trim|required'),

                                        //array('field' => 'snacks', 'label' => 'Snacks', 'rules' => 'trim|required'),

                                       // array('field' => 'printout', 'label' => 'Printout', 'rules' => 'trim|required'),

                                       // array('field' => 'laundry', 'label' => 'Laundry', 'rules' => 'trim|required'),

                                        array('field'=>'inv_address','label'=>'Invoice Ref. Address', 'rules' => 'trim|required'),

                                        array('field' => 'checked_in', 'label' => 'Checked In', 'rules' => 'trim|required'),

                                       // array('field' => 'logistics', 'label' => 'Logistics', 'rules' => 'trim|required'),

                                      );

  function __construct()

  {

    parent::__construct();          

    $this->load->model('booking_model');

  }  

  public function index()

  {

    $this->layout->view('frontend/roombooking/index');

  }

  public function create()

  {

    $this->form_validation->set_rules($this->_booking_validation_rules);       

    if($this->form_validation->run())

    {

      $form = $this->input->post();

      $ins['po_no'] = $form['po_no'];

      $ins['officer_name'] = $form['officer_name'];

      $ins['rank_id'] = $form['rank'];

      $ins['executive_id'] = $form['executive'];

      $ins['occupancy'] = $form['occupancy'];

      $ins['room_id'] = $form['room_name'];

      $ins['purpose'] = $form['purpose'];

      $ins['vessel_id'] = $form['vessel'];

      $ins['course_name'] = $form['course_name'];

      $ins['checkin_date'] = date("Y-m-d",strtotime($form['checkin_date']));

      $ins['checkin_time'] = date("H:i",strtotime($form['checkin_time']));

      $ins['checkout_date'] = date("Y-m-d",strtotime($form['checkout_date']));

      $ins['checkout_time'] = date("H:i:s",strtotime($form['checkout_time']));

      $ins['e_checkout_date'] = date("Y-m-d",strtotime($form['e_checkout_date']));

      $ins['e_checkout_time'] = date("H:i:s",strtotime($form['e_checkout_time']));

      $ins['breakfast'] = $form['breakfast'];

      $ins['lunch'] = $form['lunch'];

      $ins['snacks'] = $form['snacks'];

      $ins['laundry'] = $form['laundry'];

      $ins['inv_address'] = $form['inv_address'];

      $ins['checked_in'] = $form['checked_in'];

      $ins['logistics'] = $form['logistics'];

      $ins['discount'] = $form['discount'];

      $ins_id = $this->booking_model->insert($ins,"bookings");

      if($ins_id)

      {

        $this->session->set_flashdata("succ_msg","Room booked successfully.",TRUE);

        redirect("roombooking");

      }

      else

        $this->session->set_flashdata("fail_msg","Something wrong.",TRUE);

    }

    $this->layout->view('frontend/roombooking/create');

  }



  public function room_status()

  {

    $this->data['result'] = $this->booking_model->get_room_status();

    //echo $this->db->last_query();

    if($this->data['result'])

    {

      $data = $this->load->view("frontend/roombooking/room_status",$this->data,true);

      $output['status'] = "success";

      $output['msg'] = $data;

    }

    else

    {

      $output['status'] = "failed";

      $output['msg'] = "No Records Found.";

    }

    $this->_ajax_output($output,TRUE);

  }

}

?>

