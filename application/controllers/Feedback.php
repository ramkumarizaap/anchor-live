<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");
class Feedback extends Admin_Controller
{
  protected $_feedback_validation_rules = array (
                                    array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
                                    array('field' => 'rank', 'label' => 'Rank', 'rules' => 'trim|required'),
                                    array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                                    array('field' => 'phone', 'label' => 'Contact Number', 'rules' => 'trim|required|numeric'),
                                    array('field' => 'comments', 'label' => 'Comments', 'rules' => 'trim|required'));

	function __construct()
  {
    parent::__construct();  
    $this->load->model('feedback_model');
  }  
  public function index()
  {
    if(!is_logged_in())
          redirect("home");
    $this->layout->set_title('Feedback');
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('');
    $this->_narrow_search_conditions = array("po_no","officer_name","checkout_date_from","checkout_date_to","inv_no","invoice_link","status","pdf_downloaded");
    $str = '<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action btn-padding btn red" onclick="delete_record(\'feedback/delete/{id}\',this);"> Delete</a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('feedback_model', 'listing');
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
    $this->layout->view('frontend/feedback/index');
  }
  public function contact($edit_id='')
  {
    $this->layout->set_title('Feedback Form');
    $this->form_validation->set_rules($this->_feedback_validation_rules);       
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['name'] = $form['name'];
      $ins['rank'] = $form['rank'];
      $ins['email'] = $form['email'];
      $ins['contact_no'] = $form['phone'];
      $ins['room_id'] = $form['room_id'];
      $ins['comments'] = $form['comments'];
      if($edit_id)
      {
        $ins_id = $this->feedback_model->update(array("id"=>$edit_id),$ins,"feedback");
        $this->session->set_flashdata("success_msg","Feedback updated successfully.",TRUE);
      }
      else
      {
        $ins_id = $this->feedback_model->insert($ins,"feedback");
        $this->session->set_flashdata("success_msg","Feedback added successfully.",TRUE);
      }
      redirect("feedback/contact");
    }
    if($edit_id)
        $this->data['editdata'] = $this->feedback_model->get_where(array("id"=>$edit_id))->row_array();
    else
      $this->data['editdata'] = array("id"=>"","name"=>"","rank"=>"","email"=>"","phone"=>"","comments"=>"","room_id"=>"");
    $this->layout->view('frontend/feedback/contact');
  }
  function delete($del_id)
  {
    $access_data = $this->feedback_model->get_where(array("id"=>$del_id),'id')->row_array();     
    $output=array();
    if(count($access_data) > 0)
    {
      $this->feedback_model->delete(array("id"=>$del_id));
      $output['message'] ="Record deleted successfuly.";
      $output['status']  = "success";
    }
    else
    {
      $output['message'] ="This record not matched by feedback.";
      $output['status']  = "error";
    }      
    $this->_ajax_output($output, TRUE);            
  }
}
?>
