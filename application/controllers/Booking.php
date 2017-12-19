<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");
class Booking extends Admin_Controller 

{

  function __construct()

  {
    parent::__construct();          

    $this->load->model('booking_model');

    $this->load->library("pdf");

    if(!is_logged_in())
      redirect("home");
  }  
  public function index()
  {
   redirect("booking/logs");
 }

 public function create($edit_id='')

 {
  $this->layout->set_title('Book A Room');

  if($edit_id)

  {

    $this->form_validation->set_rules('po_no', 'Purchase Order No', 'callback_check_po_no');

  }

  $this->form_validation->set_rules($this->_booking_validation_rules());       

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

   $ins['no_of_days'] = $form['no_of_days'];

   $ins['course_name'] = $form['course_name'];

   $ins['checkin_date'] = (!empty($form['checkin_date']))?date("Y-m-d",strtotime($form['checkin_date'])):'0000-00-00';
   $ins['checkin_time'] = (!empty($form['checkin_date']))?date("H:i",strtotime($form['checkin_time'])):'00:00';

   $ins['e_checkout_date'] = (!empty($form['e_checkout_date']))?date("Y-m-d",strtotime($form['e_checkout_date'])):'0000-00-00';
   $ins['e_checkout_time'] = (!empty($form['e_checkout_date']))?date("H:i:s",strtotime($form['e_checkout_time'])):'00:00';


   $ins['checkout_date'] = (!empty($form['checkout_date']))?date("Y-m-d",strtotime($form['checkout_date'])):'0000-00-00';
   $ins['checkout_time'] = (!empty($form['checkout_date']))?date("H:i:s",strtotime($form['checkout_time'])):'00:00';

   if(!empty($form['checkin_date']) && !empty($form['checkout_date'])){

    $date1 = $form['checkin_date'].' '.$ins['checkin_time'];
    $date2 = $form['checkout_date'].' '.$ins['checkout_time'];

    $ins['no_of_days'] = $form['no_of_days'] = getStayedDays($date1, $date2);
  }  

  $ins['breakfast'] = $form['breakfast'];

  $ins['lunch'] = $form['lunch'];

  $ins['cost_centre'] = $form['cost_centre'];

  $ins['snacks'] = $form['snacks'];

  $ins['laundry'] = $form['laundry'];
  $ins['printout'] = $form['printout'];

  $ins['inv_address_id'] = $form['inv_address'];

  $ins['checked_in'] = $form['checked_in'];

  $ins['logistics'] = $form['logistics'];

  $ins['discount'] = ($ins['cost_centre']=="2")?20:$form['discount'];

  $inv_amount = $this->invoice_calc($form);
  $ins['invoice_amount'] = $inv_amount;

  $ins['status'] = "Open";
  $ins['pdf_downloaded'] = "No";

  if($edit_id)

  {

    $ins_id = $this->booking_model->update(array("id"=>$edit_id),$ins,"bookings");

    $chk = $this->booking_model->get_where(array("id"=>$edit_id),"invoice_amount,invoice_link","bookings")->row_array();

          // if($chk['invoice_link']!='' && $chk['invoice_amount']!='')

            // $this->invoice(array("id"=>$edit_id),'update');

    $this->session->set_flashdata("success_msg","Record updated successfully.",TRUE);

  }
  else
  {

          $ins['inv_no'] = get_invoicenum('bookings'); //"APH-1718-INV-".rand(1,999);

          $ins_id = $this->booking_model->insert($ins,"bookings");

          $this->session->set_flashdata("success_msg","Room booked successfully.",TRUE);

        }

        redirect("booking/logs");

      }

      if($edit_id){

        $this->data['editdata'] = $this->booking_model->get_bookings(array("a.id"=>$edit_id));

        if($this->data['editdata']['checkin_date']=='0000-00-00'){
          $this->data['editdata']['checkin_date']="";
          $this->data['editdata']['checkin_time']="";
        }
        if($this->data['editdata']['e_checkout_date']=='0000-00-00'){
          $this->data['editdata']['e_checkout_date']="";
          $this->data['editdata']['e_checkout_time']="";
        }

        if($this->data['editdata']['checkout_date']=='0000-00-00'){
          $this->data['editdata']['checkout_date']="";
          $this->data['editdata']['checkout_time']="";
        }
        

      }

      else{

        $this->data['editdata'] = array("id"=>"","po_no"=>"","officer_name"=>"","course_name"=>"","checkin_date"=>"","checkout_date"=>"","e_checkout_date"=>"","checkin_time"=>"","e_checkout_time"=>"","checkout_time"=>"","breakfast"=>"","lunch"=>"","printout"=>"","laundry"=>"","snacks"=>"","inv_address_id"=>"","logistics"=>"","discount"=>"","checked_in"=>"","rank_id"=>"","executive"=>"","occupancy"=>"","room_name"=>"","purpose"=>"","vessel"=>"","inv_address"=>"","rank"=>"","room"=>"","executives"=>"","address"=>"","cost_centre"=>"4","room_id"=>"","executive_id"=>"","rank_id"=>"","vessel_id"=>"","no_of_days"=>"");

      }

      $this->layout->view('frontend/roombooking/create');

    }

    public function invoice_calc($data){

      $inv_amount = 0;

      if($data['room_name'] && $data['no_of_days']){  

        $data['discount'] = (!empty($data['discount']))?$data['discount']:0;

        $roomdata = $this->booking_model->get_where(array("id"=>$data['room_name']),"id,tariff","rooms")->row_array();

        $total = $data['no_of_days'] * $roomdata['tariff'];

        $tt = ($total / 100 ) * $data['discount'];

        $t_value = $total - $tt;
        $cgst=($t_value / 100 ) * 6;
        $sgst=($t_value / 100 ) * 6;

        $breakfast = 0;$lunch = 0;$snacks = 0;$printout = 0;$laundry = 0;$logistics = 0;

        if($data['breakfast']!='' && is_numeric($data['breakfast']))
          $breakfast = $data['breakfast'];

        if($this->data['invoice']['lunch']!='' && is_numeric($data['lunch']))
          $lunch = $this->data['invoice']['lunch'];

        if($data['snacks']!='' && is_numeric($data['snacks']))
          $snacks = $data['snacks'];

        if($data['printout']!='' && is_numeric($data['printout']))
          $printout = $data['printout'];

        if($data['laundry']!='' && is_numeric($data['laundry']))
          $laundry = $data['laundry'];

        if($data['logistics']!='' && is_numeric($data['logistics']))
          $logistics = $data['logistics'];

        $inv_amount = ceil($t_value + $cgst + $sgst + $breakfast + $lunch + $snacks + $printout + $laundry + $logistics);
      }

      return $inv_amount;  
    }

    public function _booking_validation_rules(){

      $roomvalidate = (get_user_data()['role']==1)? '|required':'';

      return $validation_rules = array (

        array('field' => 'po_no', 'label' => 'Purchase Order No', 'rules' => 'trim'),

        array('field' => 'officer_name', 'label' => 'Officer Name', 'rules' => 'trim'),

        array('field' => 'rank', 'label' => 'Rank', 'rules' => 'trim'),

        array('field' => 'executive', 'label' => 'Booking Executive', 'rules' => 'trim'),

        array('field' => 'occupancy', 'label' => 'Occupancy', 'rules' => 'trim'),

        array('field' => 'room_name', 'label' => 'Room Name', 'rules' => 'trim'.$roomvalidate),

        array('field' => 'purpose', 'label' => 'Purpose of Visit', 'rules' => 'trim'),

        array('field' => 'vessel', 'label' => 'Assigned Vessel', 'rules' => 'trim'),

        array('field' => 'course_name', 'label' => 'Course Name', 'rules' => 'trim'),

        array('field' => 'checkin_date', 'label' => 'Checkin Date', 'rules' => 'trim'),

        array('field' => 'checkin_time', 'label' => 'Checkin Time', 'rules' => 'trim'),

        array('field' => 'checkout_date', 'label' => 'Checkout Date', 'rules' => 'trim'),

        array('field' => 'checkout_time', 'label' => 'Checkout Time', 'rules' => 'trim'),

        array('field' => 'e_checkout_date', 'label' => 'Expected Checkout Date', 'rules' => 'trim'),

        array('field' => 'e_checkout_time','label' => 'Expected Checkout Time','rules' =>'trim'),

        array('field' => 'breakfast', 'label' => 'Breakfast', 'rules' => 'trim'),

        array('field' => 'lunch', 'label' => 'Lunch', 'rules' => 'trim'),

        array('field' => 'snacks', 'label' => 'Snacks', 'rules' => 'trim'),

        array('field' => 'printout', 'label' => 'Printout', 'rules' => 'trim'),

        array('field' => 'laundry', 'label' => 'Laundry', 'rules' => 'trim'),

        array('field'=>'inv_address','label'=>'Invoice Ref. Address', 'rules' => 'trim'),

        array('field' => 'checked_in', 'label' => 'Checked In', 'rules' => 'trim|required'),

        array('field' => 'logistics', 'label' => 'Logistics', 'rules' => 'trim'),

        );
}

public function check_po_no($str)

{

  $chk = $this->booking_model->get_where(array("po_no"=>$str))->row_array();

  if($chk)

  {

    $this->form_validation->set_message('check_po_no', 'This '.$str.' {field} already exists.');

    return false;

  }

  else

    return true;

}



public function logs()

{

  /*Room Booking*/

  $this->layout->set_title('Booking Logs');      
  $this->layout->add_stylesheets(array('jquery.signaturepad'));
  $this->layout->add_javascripts(array('listing','jsignature/jquery.signaturepad'));

  $this->load->library('listing');

  $this->simple_search_fields = array('');

  $this->_narrow_search_conditions = array("po_no","officer_name","checkout_date_from","checkout_date_to","inv_no","invoice_link","status","pdf_downloaded");

  $str = '<a href="'.site_url('booking/create/{id}').'" class="table-action" target="_blank"><i class="fa fa-edit edit"></i> Edit</a>';
  if(get_user_data()['role']=="1"){ 
    $str .='<br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'booking/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';
  }

  $this->listing->initialize(array('listing_action' => $str));

  $listing = $this->listing->get_listings('booking_model', 'listing');

  if($this->input->is_ajax_request())

    $this->_ajax_output(array('listing' => $listing), TRUE);

  $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

  $this->data['simple_search_fields'] = $this->simple_search_fields;

  $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

  $this->data['per_page'] = $this->listing->_get_per_page();

  $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

  $this->data['search_bar'] = $this->load->view('frontend/roombooking/search_bar', $this->data, TRUE);

  $this->data['listing'] = $listing;

  $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

  $this->layout->view('/frontend/roombooking/logs');

}



public function operation()

{

  $opt = explode(",",$_POST['opt']);

  $order = $_POST['order'];

  for ($i=0; $i <count($opt) ; $i++)

  {

    if($order=="1" || $order==1)

      $up['status']= "Closed";

    else if($order=="2" || $order==2)

      $up['invoice_link'] = base_url().$this->invoice($opt[$i]);

    else

      $up['pdf_downloaded'] = "Yes";

    $ins_id = $this->booking_model->update(array("id"=>$opt[$i]),$up,"bookings");

  }

}

public function view_invoice($id='')
{
  $this->data['id'] = $id;
  $this->data['invoice'] = $this->booking_model->get_bookings(array("a.id"=>$id));
  $this->load->view("/frontend/roombooking/invoice",$this->data);
}

public function download_pdf($id='')
{
  $this->data['invoice'] = $this->booking_model->get_bookings(array("a.id"=>$id));
  $ins['pdf_downloaded'] = "Yes";
  $update = $this->booking_model->update(array("id"=>$id),$ins,"bookings");
  $html = $this->load->view("/frontend/roombooking/invoice",$this->data,true);
  $pdf = $this->pdf->load();
  $pdf->setFooter("Page {PAGENO} of {nb}");
  $pdf->WriteHTML($html);
  $pdfpath = $this->data['invoice']['inv_no'].".pdf";
  $pdf->Output($pdfpath, 'D');
}


public function invoice($id='',$action='')

{

  $id = ($this->input->post('r_id'))?$this->input->post('r_id'):explode(' ',$id);
      // echo "<pre>";print_r($id);
      // exit;
  if(!empty($id) || is_array($id) || $id!='')
  {
    foreach ($id as $value)
    {
      $this->data['invoice'] = $this->booking_model->get_bookings(array("a.id"=>$value));

      $date1=date("Y-m-d H:i:s",strtotime($this->data['invoice']['checkin_date']." ".$this->data['invoice']['checkin_time']));
      $date2=date("Y-m-d H:i:s",strtotime($this->data['invoice']['checkout_date']." ".$this->data['invoice']['checkout_time']));

      $days = getStayedDays($date1, $date2);

      $this->data['days'] = $days;

          // $html = $this->load->view("/frontend/roombooking/invoice",$this->data,true);
          // $pdf = $this->pdf->load();
          // $pdf->setFooter("Page {PAGENO} of {nb}");         
          // $pdf->WriteHTML($html);
      $pdfpath = "booking/view_invoice/".$this->data['invoice']['id'];

          // $pdf->Output($pdfpath, 'F');         

          //$days = ceil(abs(strtotime($date2) - strtotime($date1)) / 100400);
      $total = $days * $this->data['invoice']['tariff'];
      $tt = ($total / 100 ) * $this->data['invoice']['discount'];
      $t_value = $total - $tt;
      $cgst=($t_value / 100 ) * 6;
      $sgst=($t_value / 100 ) * 6;
      if($action!="update")
      {
        $ins['no_of_days'] = ($_POST['days'][$value])? $_POST['days'][$value] : $days;
      }
      $breakfast = 0;$lunch = 0;$snacks = 0;$printout = 0;$laundry = 0;$logistics = 0;
      if($this->data['invoice']['breakfast']!='' && is_numeric($this->data['invoice']['breakfast']))
        $breakfast = $this->data['invoice']['breakfast'];
      if($this->data['invoice']['lunch']!='' && is_numeric($this->data['invoice']['lunch']))
        $lunch = $this->data['invoice']['lunch'];
      if($this->data['invoice']['snacks']!='' && is_numeric($this->data['invoice']['snacks']))
        $snacks = $this->data['invoice']['snacks'];
      if($this->data['invoice']['printout']!='' && is_numeric($this->data['invoice']['printout']))
        $printout = $this->data['invoice']['printout'];
      if($this->data['invoice']['laundry']!='' && is_numeric($this->data['invoice']['laundry']))
        $laundry = $this->data['invoice']['laundry'];
      if($this->data['invoice']['logistics']!='' && is_numeric($this->data['invoice']['logistics']))
        $logistics = $this->data['invoice']['logistics'];

      $ins['invoice_date'] = date('Y-m-d');
      $ins['invoice_amount'] = ceil($t_value + $cgst + $sgst + $breakfast + $lunch + $snacks + $printout + $laundry + $logistics);          
      $ins['invoice_link'] = base_url().$pdfpath;
      $update = $this->booking_model->update(array("id"=>$value),$ins,"bookings");
    }
  }
  if($action=="update")
  {
    return $ins['invoice_link'];
  }
  else
  {
    $output['msg'] = "<h4 style='text-align:center;padding:20px;width:100%;'><b>Invoice generated successfully.</b></h4>";
    $output['status'] = "success";
    $this->_ajax_output($output,TRUE);
  }
}



    // public function pdfupload()

    // {

    //   $path = $this->do_upload()['upload_data']['file_name'];

    //   $res = $this->ExtractTextFromPdf("assets/pdf/".$path)[0];

    //   $q = array();$i=0;

    //   $q['checkout_date'] = "";

    //   $q['checkout_time'] = "";

    //   $q['vessel'] = get_ajax_row_id(array("name"=>$res['11']),"vessels");

    //   $q['po_no'] = $res['8'];

    //   $a = explode(" ",$res['14']);

    //   $date = explode("/",$a[0]);

    //   $checkindate = date("Y-m-d",strtotime($date[0]."-".$date[1]."-".$date[2]));

    //   $checkintime = date("H:i",strtotime($a[1]));

    //   $q['checkin_date'] = $checkindate;

    //   $q['checkin_time'] = $checkintime;

    //   $d2 = strtotime($res['17'])?"true":"false";

    //   if($d2=="true")

    //   {

    //     $i = $i + 1;

    //     $b = explode(" ",$res['17']);

    //     $date1 = explode("/",$b[0]);

    //     $checkoutdate = date("Y-m-d",strtotime($date1[0]."-".$date1[1]."-".$date1[2]));

    //     $checkoutime = date("H:i",strtotime($b[1]));

    //     $q['checkout_date'] = $checkoutdate;

    //     $q['checkout_time'] = $checkoutime;

    //   }

    //   $num = is_numeric($res[18+$i])?"true":"false";

    //   if($num=="true")

    //   {

    //     $i = $i+1;

    //   }

    //   $q['rank'] = get_ajax_row_id(array("name"=>$res[27+$i]),"rank");

    //   $q['officer_name'] = trim($res[26+$i]," ");

    //   $exe = explode(":",$res[34+$i]);

    //   $q['executive'] = get_ajax_row_id(array("name"=>trim($exe['1'])),"executives");

    //   unlink("assets/pdf/".$path);

    //   echo json_encode($q);

    // }

public function pdfupload()

{

  $path = $this->do_upload()['upload_data']['file_name'];

  $formats = array("d/m/Y H:i", "d/M/Y H:i");

  $a = $this->ExtractTextFromPdf("assets/pdf/".$path);

  $q = array();$i=0;

  $d = 0;

  $checkout_date= "";$p="";$rank="";

  foreach ($a[0] as $key => $value)

  {

    if (strpos($value, 'Order By') !== false)

    {

      $exe = explode(":",$value);

      $executive = trim($exe[1]);

    }

    if (strpos($value, 'PO/') !== false)

    {

      $po = $value;

      $p = $key;

    }



    foreach ($formats as $format)

    {

      $date = DateTime::createFromFormat($format, $value);

      if ($date == true)

      {

        if($d==0)

        {

          $checkin_date = $value;

          $d = 1;

        }

        else if($d==1)

          $checkout_date = $value;

      }

    }

    if(isset($p) && $p!='')

      $vessel = $a[0][$p+3];

    if (strpos($value, 'Crew code') !== false)

      $rank = $a[0][$key+4];

    if (strpos($value, 'Crew name') !== false)

      $officer = $a[0][$key+6];

  }

  $q['vessel'] = get_ajax_row_id(array("name"=>$vessel),"vessels");

  $q['po_no'] = $po;

  $ct = explode(" ",$checkin_date);

  $date = explode("/",$checkin_date);

  $checkindate = date("Y-m-d",strtotime($date[0]."-".$date[1]."-".$date[2]));

  $checkintime = date("h:i",strtotime($ct[1]));

  $q['checkin_date'] = $checkindate;

  $q['checkin_time'] = $checkintime;

  if($checkout_date!='')

  {

    $b = explode(" ",$checkout_date);

    $date1 = explode("/",$b[0]);

    $checkoutdate = date("Y-m-d",strtotime($date1[0]."-".$date1[1]."-".$date1[2]));

    $checkoutime = date("H:i",strtotime($b[1]));

    $q['checkout_date'] = $checkoutdate;

    $q['checkout_time'] = $checkoutime;

  }

  $q['rank'] = get_ajax_row_id(array("name"=>$rank),"rank");

  $q['officer_name'] = trim($officer," ");

  $q['executive'] = get_ajax_row_id(array("name"=>trim($executive)),"executives");

  unlink("assets/pdf/".$path);

  echo json_encode($q);

}

public function do_upload()

{

  $config['upload_path']          = 'assets/pdf/';

  $config['allowed_types']        = 'gif|jpg|png|pdf';

      // $config['max_size']             = 10000;

      // $config['max_width']            = 2024;

      // $config['max_height']           = 1768;

  $this->load->library('upload', $config);

  if ( ! $this->upload->do_upload('file'))

  {

    $error = array('error' => $this->upload->display_errors());

        // $this->load->view('upload_form', $error);

    return $error;

  }

  else

  {

    $data = array('upload_data' => $this->upload->data());

        // $this->load->view('upload_success', $data);

    return $data;

  }

}





public function export_excel()

{

 $where = array();$pdf_link = "";$date = "";

 if(isset($_POST['search_officer_name']) && $_POST['search_officer_name']!='')

 {

  $where['a.officer_name'] = $_POST['search_officer_name'];

}

if(isset($_POST['search_from_date']) && $_POST['search_from_date']!='')

{

  $date['a.checkout_date>='] = date("Y-m-d",strtotime($_POST['search_from_date']));

}

if(isset($_POST['search_to_date']) && $_POST['search_to_date']!='')

{

  $date['a.checkout_date<='] = date("Y-m-d",strtotime($_POST['search_to_date']));

}

if(isset($_POST['search_inv_no']) && $_POST['search_inv_no']!='')

{

  $where['a.inv_no'] = $_POST['search_inv_no'];

}

if(isset($_POST['search_po_no']) && $_POST['search_po_no']!='')

{

  $where['a.po_no'] = $_POST['search_po_no'];

}

if(isset($_POST['search_pdf_link']) && $_POST['search_pdf_link']!='')
{
  $pdf_link = $_POST['search_pdf_link'];
}
if(isset($_POST['search_order_status']) && $_POST['search_order_status']!='')
{
  $where['a.status'] = $_POST['search_order_status'];
}
if(isset($_POST['search_pdf_downloaded']) && $_POST['search_pdf_downloaded']!='')
{
  $where['a.pdf_downloaded'] = $_POST['search_pdf_downloaded'];
}
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=Room-Booking-'.date("Y-m-d").'.xls');
$books = $this->booking_model->get_room_bookings($where,$pdf_link,$date);
      // echo "<pre>";print_r($books);exit;
$str = "<table border=1>

<thead>

<th>SNo</th><th>Invoice No</th><th>PO NO</th><th>Officer Name</th><th>Rank</th><th>Booking Executive</th>

<th>Purpose of Visit</th><th>course Name</th><th>Assigned Vessel</th><th>Checkin Date</th><th>Checked In</th>

<th>Checkout Date</th><th>Occupancy</th><th>Room</th><th>Room Tariff</th><th>Breakfast</th>

<th>Lunch</th><th>Snacks</th><th>Printout</th><th>Laundry</th><th>Logisitcs</th><th>Discount Amt</th>

<th>Invoice Amt</th><th>Pdf Downmloaded</th>

</thead>

<tbody>";

$i=1;

foreach ($books as $value)

{

  $str .= "<tr>

  <td>".$i++."</td>

  <td>".$value['inv_no']."</td>

  <td>".$value['po_no']."</td>

  <td>".$value['officer_name']."</td>

  <td>".$value['rank']."</td>

  <td>".$value['executive']."</td>

  <td>".$value['purpose']."</td>

  <td>".$value['course_name']."</td>

  <td>".$value['vessel']."</td>

  <td>".$value['checkin_date']."</td>

  <td>".$value['checked_in']."</td>

  <td>".$value['checkout_date']."</td>

  <td>".$value['occupancy']."</td>

  <td>".$value['room']."</td>

  <td>".$value['tariff']."</td>

  <td>".$value['breakfast']."</td>

  <td>".$value['lunch']."</td>

  <td>".$value['snacks']."</td>

  <td>".$value['printout']."</td>

  <td>".$value['laundry']."</td>

  <td>".$value['logistics']."</td>

  <td>".$value['discount']."</td>

  <td>".$value['invoice_amount']."</td>

  <td>".$value['pdf_downloaded']."</td>

  </tr>";

}

$str .= "</tbody>

</table>";

echo $str;

}

function ExtractTextFromPdf ($pdfdata)

{

      if (strlen ($pdfdata) < 1000 && file_exists ($pdfdata)) $pdfdata = file_get_contents ($pdfdata); //get the data from file

      if (!trim ($pdfdata)) echo "Error: there is no PDF data or file to process.";

      $result = array(); //this will store the results

      //Find all the streams in FlateDecode format (not sure what this is), and then loop through each of them

      if (preg_match_all ('/<<[^>]*FlateDecode[^>]*>>\s*stream(.+)endstream/Uis', $pdfdata, $m)) foreach ($m[1] as $chunk)

      {

        $chunk = gzuncompress (ltrim ($chunk)); //uncompress the data using the PHP gzuncompress function

        //$chunk = iconv('UTF-8', 'ASCII//TRANSLIT', $chunk); //suggested in comments to code above to remove junk characters

        //If there are [] in the data, then extract all stuff within (), or just extract () from the data directly

        $a = preg_match_all ('/\[([^\]]+)\]/', $chunk, $m2) ? $m2[1] : array ($chunk); //get all the stuff within []

        foreach ($a as $subchunk)

        {

          if (preg_match_all ('/\(([^\)]+)\)/', $subchunk, $m3))

          {

            //$result []= join ('', $m3[1]); //within ()

            $result []= $m3[1]; //within ()

          }

        } 

      }

      else $result = "Error: there is no FlateDecode text in this PDF file that I can process.";

      return $result; //return what was found

    }

    public function get_selected_records()

    {

      $id = $this->input->post('id');

      $this->data['records'] = $this->booking_model->get_where(array("id"=>$id),"*","bookings")->result_array();

      $output['msg'] = $this->load->view("frontend/roombooking/records",$this->data,true);

      $output['status'] = "success";

      $output['records'] = $this->data['records'];

      $this->_ajax_output($output,TRUE);

    }
    function delete($del_id)
    {
      $access_data = $this->booking_model->get_where(array("id"=>$del_id),'id')->row_array();     
      $output=array();
      if(count($access_data) > 0)
      {
        $this->booking_model->delete(array("id"=>$del_id));
        $output['message'] ="Record deleted successfuly.";
        $output['status']  = "success";
      }
      else
      {
        $output['message'] ="Can't able to delete.";
        $output['status']  = "error";
      }      
      $this->_ajax_output($output, TRUE);            
    }

    function signature_form()
    {
      $id = $this->input->post('id');
      $this->data['result'] = $this->booking_model->get_where(array("id"=>$id),"*","bookings")->row_array();
      $output['msg'] = $this->load->view("frontend/roombooking/signature_form",$this->data,true);
      $output['status'] = "success";
      $this->_ajax_output($output,TRUE);
    }
    function submit_sign()
    {
      if(isset($_POST['e_sign']))
        $up['executive_sign'] = $this->input->post('e_sign');
      if(isset($_POST['o_sign']))
        $up['officer_sign'] = $this->input->post('o_sign');
      $id = $this->input->post('id');
      $update = $this->booking_model->update(array("id"=>$id),$up,"bookings");
      $output['msg'] = "Signature submitted Successfully";
      $output['status'] = "success";
      $this->_ajax_output($output,TRUE);
    }



     function get_pending_records()
      {
   $dummyid = $this->input->post('id');

     if($dummyid=='1')
      {
     // $this->data['pending_result']=$this->booking_model->get_where(array("invoice_link"=>NULL),"*","bookings")->result_array();
     // $output['messages'] = $this->load->view("frontend/roombooking/pending_invoice",$this->data,true);
     // $output['status'] = "success";
     // $this->_ajax_output($output,TRUE);

     $this->data['pending_result']=$this->booking_model->pending_list();
     $output['messages'] = $this->load->view("frontend/roombooking/pending_invoice",$this->data,true);
     $output['status'] = "success";
     $this->_ajax_output($output,TRUE);
      }
     
   }

  public function send_email()
  {
     $fetch_result=$this->booking_model->sending_email();
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

