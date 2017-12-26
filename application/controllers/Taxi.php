<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



require_once(APPPATH."libraries/Admin_controller.php");



class Taxi extends Admin_Controller 

{

	protected $_taxi_validation_rules = array (

                                    array('field' => 'driver_name', 'label' => 'Driver Name', 'rules' => 'trim|required'),

                                    array('field' => 'officer_name', 'label' => 'Officer Name', 'rules' => 'trim|required'),

                                    array('field' => 'rank', 'label' => 'Rank', 'rules' => 'trim|required'),

                                    array('field' => 'to', 'label' => 'To Location', 'rules' => 'trim|required'),

                                    array('field' => 'from', 'label' => 'From Location', 'rules' => 'trim|required'),

                                    array('field' => 'date', 'label' => 'Pickup Date', 'rules' => 'trim|required'),

                                    array('field' => 'trip_sheet', 'label' => 'Trip Sheet No', 'rules' => 'trim|required'),

                                    array('field' => 'vessel', 'label' => 'Vessel', 'rules' => 'trim|required'),

                                    array('field' => 'charge', 'label' => 'Charge', 'rules' => 'trim|required'),

                                    array('field' => 'day_type', 'label' => 'Day Type', 'rules' => 'trim|required'),

                                    array('field' => 'kms', 'label' => 'No.of Kms', 'rules' => 'trim|required'),

                                    array('field' => 'cash_received', 'label' => 'Cash Received', 'rules' => 'trim|required'),

                                    array('field' => 'rate', 'label' => 'Rate', 'rules' => 'trim|required'),

                                    array('field' => 'discount', 'label' => 'Discount', 'rules' => 'trim|numeric'),);

	

    function __construct()

    {

        parent::__construct();          

        $this->load->model('taxi_model');

        $this->load->library("pdf");

        if(!is_logged_in())

          redirect("home");

    }  



    public function index()

    {

    	redirect("taxibooking/logs");

    }

    public function create($edit_id='')

	  {

      $this->layout->set_title('Book A Taxi');

	    $this->form_validation->set_rules($this->_taxi_validation_rules);       

	    if($this->form_validation->run())

	    {

	      $form = $this->input->post();

	      $ins['driver_name'] = $form['driver_name'];

	      $ins['officer_name'] = $form['officer_name'];

	      $ins['rank'] = $form['rank'];

	      $ins['to_loc'] = $form['to'];

	      $ins['from_loc'] = $form['from'];

	      $ins['date'] = date("Y-m-d",strtotime($form['date']));

	      $ins['trip_sheet'] = $form['trip_sheet'];

	      $ins['vessel'] = $form['vessel'];

	      $ins['waiting'] = $form['waiting'];

	      $ins['toll'] = $form['toll'];

        $ins['cost_centre'] = $form['cost_centre'];

	      $ins['parking'] = $form['parking'];

        $ins['day_type'] = $form['day_type'];

        $ins['kms'] = $form['kms'];

        $ins['amount'] = $form['charge'];
        if($ins['cost_centre']=="2")
          $ins['discount'] = 20;
        else
          $ins['discount'] = $form['discount'];

        $dis = ($form['charge'] / 100) * $form['discount'];

        $tot = $form['charge'] - $dis;

        $ins['cgst'] = (($tot + $form['toll'] + $form['parking']) / 100 ) * 2.5;

        $ins['sgst'] = (($tot + $form['toll'] + $form['parking']) / 100 ) * 2.5;

        $ins['invoice_sent'] = ($form['invoice_sent'])?$form['invoice_sent']:"No";

        $ins['cash_received'] = $form['cash_received'];
        $ins['inv_address'] = $form['inv_address'];

        $ins['total'] = ceil($tot + $ins['toll'] + $ins['parking']);

        $ins['grand_total'] = ceil($ins['total'] + $ins['sgst'] + $ins['cgst']);

        if($edit_id)

        {

          $ins['updated_date'] = date("Y-m-d H:i:s");

          $this->taxi_model->update(array("id"=>$edit_id),$ins,"taxi_booking");

          $this->invoice($edit_id);

          $this->session->set_flashdata("success_msg","Record updated successfully.",TRUE);

        }

        else
         {
         //  $find_id = $this->taxi_model->to_check();
         //  $check_year=explode("-",$find_id->inv_no);
         //  $current_year=date("Y");
         // if($check_year[1]!=$current_year)
         // {
         //   $ins['inv_no']= "APH"."-".$current_year."-"."1";
         // }
         // else
         // {
         //  $last_id=$check_year[2]+1;
         //  $ins['inv_no']= "APH"."-".$current_year."-".$last_id;
         // }  

         //  $ins['inv_no'] = get_invoicenum('taxi_booking'); //"APH-1718-INV-".rand(0,999);

          $current_year=date("Y-m-d");
          $check_year=explode("-",$current_year);

         if($check_year[1]=="03")
         {
           $find_id = $this->taxi_model->to_check();
           $last_id=$find_id->invoice_number;
           $check_already_exists=explode("-",$last_id);
           if($check_already_exists[2]=="03")
           {
          $last_id=$check_already_exists[3]+1;
          $ins['invoice_number']= "APH"."-".$check_year[0]."-".$check_year[1]."-".$last_id;
          $cur=date("y");
          $next_year = date("y",strtotime("+1 year"));
          $ins['inv_no']= "AP".$cur.$next_year."-".$last_id;
           }
           else
           {
          $ins['invoice_number']= "APH"."-".$check_year[0]."-".$check_year[1]."-"."1";
          $cur=date("y");
          $next_year = date("y",strtotime("+1 year"));
          $ins['inv_no']= "AP".$cur.$next_year."-"."1";
            }
         }
         else
         {
           $find_id = $this->taxi_model->to_check();
           $last_id=$find_id->invoice_number;
           if($last_id!='')
           {
            $check_already_exists=explode("-",$last_id);
            $last_id=$check_already_exists[3]+1;
            $ins['invoice_number']= "APH"."-".$check_year[0]."-".$check_year[1]."-".$last_id;
            $cur=date("y");
            $next_year = date("y",strtotime("+1 year"));
            $ins['inv_no']= "AP".$cur.$next_year."-".$last_id;
           }
           else
           {
            $ins['invoice_number']= "APH"."-".$check_year[0]."-".$check_year[1]."-"."1";
            $cur=date("y");
            $next_year = date("y",strtotime("+1 year"));
            $ins['inv_no']= "AP".$cur.$next_year."-"."1";
           }
           
          
         }  

           $ins['created_date'] = "2017-08-31 00:00:00"; //date("Y-m-d H:i:s");
           $ins_id = $this->taxi_model->insert($ins,"taxi_booking");

            $this->invoice($ins_id);

	         $this->session->set_flashdata("success_msg","Taxi booked successfully.",TRUE);

        }

        redirect("taxi/logs");

	    }

      if($edit_id)

        $this->data['editdata'] = $this->taxi_model->get_bookings(array("a.id"=>$edit_id));

      else

        $this->data['editdata'] = array("id"=>"","driver_name"=>"","officer_name"=>"","to_loc"=>"","from_loc"=>"","date"=>"","trip_sheet"=>"","waiting"=>"","toll"=>"25","parking"=>"","rank"=>"","vessel"=>"","charge"=>"","day_type"=>"","kms"=>"","cost_centre"=>"","cash_received"=>"","rate"=>"","discount"=>"","invoice_sent"=>"","inv_address"=>"");

	    $this->layout->view('frontend/taxibooking/create');

	  }



    public function waiting_charge($waiting)

    {

      $charge = $this->taxi_model->get_charge('',"taxi_normal_charge");

      switch ($waiting)

      {

        case '30':

            $data = $charge['waiting_charge'] / 2;

          break;

        case '60':

            $data = $charge['waiting_charge'];

          break;

        case '90':

            $data = $charge['waiting_charge'] + ($charge['waiting_charge'] / 2);

          break;

        case '120':

            $data = $charge['waiting_charge'] * 2;

          break;

        case '150':

            $data = ($charge['waiting_charge'] * 2) + ($charge['waiting_charge'] / 2);

          break;

      }

      return $data;

    }



	  public function logs()

	  {



      $this->layout->set_title('Taxi Booking Logs');

	  	$this->layout->add_javascripts(array('listing'));

      $this->load->library('listing');

      $this->simple_search_fields = array('');

      $this->_narrow_search_conditions = array("driver_name","officer_name","from_date","to_date","trip_sheet","inv_no");

      $str = '<a href="'.site_url('taxi/create/{id}').'" class="table-action"><i class="fa fa-edit edit"></i> Edit</a>';
    if(get_user_data()['role']=="1"){ 
        $str .='<br><a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action font-red" onclick="delete_record(\'taxi/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i> Delete</a>';
      }


      $this->listing->initialize(array('listing_action' => $str));

      $listing = $this->listing->get_listings('taxi_model', 'listing');

      if($this->input->is_ajax_request())

          $this->_ajax_output(array('listing' => $listing), TRUE);

      $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');

      $this->data['simple_search_fields'] = $this->simple_search_fields;

      $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');

      $this->data['per_page'] = $this->listing->_get_per_page();

      $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());

      $this->data['charge'] = $this->taxi_model->get_charge('',"taxi_normal_charge");

      $this->data['search_bar'] = $this->load->view('frontend/taxibooking/search_bar', $this->data, TRUE);

      $this->data['listing'] = $listing;

      $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);

	  	$this->layout->view('/frontend/taxibooking/logs');

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

          $up['invoice_link'] = base_url()."booking/invoice/".$opt[$i];

        else

          $up['pdf_downloaded'] = "Yes";

        $ins_id = $this->booking_model->update(array("id"=>$opt[$i]),$up,"bookings");

      }

    }



    // public function invoice($id='')

    // {

    //   $this->data['invoice'] = $this->booking_model->get_bookings(array("a.id"=>$id));

    //   $this->load->view("/frontend/roombooking/invoice",$this->data);

    // }



    public function add_location()

    {

      $ins['name'] = $_POST['location'];

      $ins_id = $this->taxi_model->insert($ins,"locations");

      if($ins_id)

      {

        $output['status'] = "success";

        $output['msg'] = "Location inserted successfully.";

        $output['class'] = "green";

      }

      else

      {

        $output['status'] = "success";

        $output['msg'] = "Location not inserted";

        $output['class'] = "red";

      }

      echo json_encode($output);

    }

     public function add_charge()

    {

      $ins['waiting_charge'] = $_POST['waiting_charge'];

      $ins['day_charge'] = $_POST['normal_day_charge'];

      $ins['night_charge'] = $_POST['normal_night_charge'];

      $ins1['from_loc'] = $_POST['from_loc'];

      $ins1['to_loc'] = $_POST['to_loc'];

      $ins1['kms'] = $_POST['kms'];

      $ins1['day_charge'] = $_POST['fixed_day_charge'];

      $ins1['night_charge'] = $_POST['fixed_night_charge'];

      $up = $this->taxi_model->update(array("id"=>"1"),$ins,"taxi_normal_charge");

      $charge =$this->taxi_model->get_charge(array("from_loc"=>$_POST['from_loc'],"to_loc"=>$_POST['to_loc']),"taxi_fixed_charge");

      if($charge)

      {

        $ins_id = $this->taxi_model->update(array("id"=>"1"),$ins1,"taxi_fixed_charge");

      }

      else

      {

        // $ins_id = $this->taxi_model->insert($ins,"taxi_normal_charge");

        $ins_id = $this->taxi_model->insert($ins1,"taxi_fixed_charge");

      }

      if($ins_id)

      {

        $output['status'] = "success";

        $output['msg'] = "Taxi Charge inserted successfully.";

        $output['class'] = "green";

      }

      else

      {

        $output['status'] = "success";

        $output['msg'] = "Taxi Charge not inserted";

        $output['class'] = "red";

      }

      echo json_encode($output);

    }



    public function get_charge()

    {

      $waiting = $_POST['waiting'];

      if($waiting!="")

        $waiting = $this->waiting_charge($waiting);

      else

        $waiting = "0";

      $kms = $_POST['kms'];

      $day = $_POST['day'];

      $from = $_POST['from'];

      $to = $_POST['to'];

      $rate = $_POST['rate'];

      if($rate=="Fixed")

      {

        $get = $this->taxi_model->get_charge(array("from_loc"=>$from,"to_loc"=>$to),"taxi_fixed_charge");

        if($day=="Day")

          $output['amount'] = $get['day_charge'] + $waiting;

        else

          $output['amount'] = $get['night_charge'] + $waiting;

        $output['kms'] = $get['kms'];

      }

      else

      {

        $get = $this->taxi_model->get_charge('',"taxi_normal_charge");

        if($day=="Day")

          $output['amount'] = $kms * $get['day_charge'] + $waiting;

        else

          $output['amount'] = $kms * $get['night_charge'] + $waiting;

      }

      echo json_encode($output);

    }

    public function ajax_get_charge()

    {

      $from = $_POST['from'];

      $to = $_POST['to'];

      if($from!='' && $to!='')

      {

        $get = $this->taxi_model->get_charge(array("from_loc"=>$from,"to_loc"=>$to),"taxi_fixed_charge");

        $get['msg']="success";

      }

      else

        $get['msg']="failed";

      

      $this->_ajax_output($get,TRUE);

    }

    public function invoice($id='')

    {

      $this->data['invoice'] = $this->taxi_model->get_bookings(array("a.id"=>$id));

      $html = $this->load->view("/frontend/taxibooking/invoice",$this->data,TRUE);

      $pdf = $this->pdf->load();

      $pdf->setFooter("Page {PAGENO} of {nb}");

      // $pdf->WriteHTML($css,1);

      $pdf->WriteHTML($html);

      $pdfpath = "assets/pdf/invoice/taxi/".$this->data['invoice']['inv_no'].".pdf";

      $pdf->Output($pdfpath, 'F');

      $ins['invoice_link'] = base_url().$pdfpath;

      $ins_id = $this->taxi_model->update(array("id"=>$id),$ins,"taxi_booking");

      return $pdfpath;

    }



    public function export_excel()

    {

      // print_r($_POST);

      $where = array();$remarks = "";$fuel="";$maintainence="";

      if(isset($_POST['search_officer_name']) && $_POST['search_officer_name']!='')

      {

        $where['a.officer_name'] = $_POST['search_officer_name'];

      }

      if(isset($_POST['search_from_date']) && $_POST['search_from_date']!='')

      {

        $where['a.date>='] = $_POST['search_from_date'];

      }

      if(isset($_POST['search_to_date']) && $_POST['search_to_date']!='')

      {

        $where['a.date<='] = $_POST['search_to_date'];

      }

      if(isset($_POST['search_inv_no']) && $_POST['search_inv_no']!='')

      {

        $where['a.inv_no'] = $_POST['search_inv_no'];

      }

      if(isset($_POST['search_driver_name']) && $_POST['search_driver_name']!='')

      {

        $where['a.driver_name'] = $_POST['search_driver_name'];

      }

      if(isset($_POST['search_trip_sheet']) && $_POST['search_trip_sheet']!='')

      {

        $where['a.trip_sheet'] = $_POST['search_trip_sheet'];

      }

      if(isset($_POST['remarks']) && $_POST['remarks']!='')

        $remarks = $_POST['remarks'];

      if(isset($_POST['fuel']) && $_POST['fuel']!='')

        $fuel = $_POST['fuel'];

      if(isset($_POST['maintainence']) && $_POST['maintainence']!='')

        $maintainence = $_POST['maintainence'];

      $tt = $fuel + $maintainence;

      header('Content-type: application/vnd.ms-excel');

      header('Content-Disposition: attachment; filename=Taxi-Booking-'.date("Y-m-d").'.xls');

      $books = $this->taxi_model->get_all_bookings($where);

      $str = "<table border=1>

                <thead>

                  <th>Invoice No</th><th>Driver Name</th><th>Officer Name</th><th>Rank</th><th>Vessel</th><th>Date</th>

                  <th>From</th><th>To</th><th>Trip Sheet</th><th>No.of KM</th><th>Waiting Charge</th><th>Amount</th>

                  <th>CGST 6%</th><th>SGST 6%</th><th>Toll</th><th>Parking</th><th>Invoice Sent</th><th>Cash Received</th>

                  <th>Total</th><th>Grand Total</th><th>Fuel & Maintainence</th><th>Remarks</th><th>Profit/Loss</th>

                </thead>

              <tbody>";

      $i=0;

      foreach ($books as $value)

      {

        $str .= "<tr>

                  <td>".$value['inv_no']."</td>

                  <td>".$value['driver_name']."</td>

                  <td>".$value['officer_name']."</td>

                  <td>".$value['rank']."</td>

                  <td>".$value['vessel']."</td>

                  <td>".$value['date']."</td>

                  <td>".$value['from_loc']."</td>

                  <td>".$value['to_loc']."</td>

                  <td>".$value['trip_sheet']."</td>

                  <td>".$value['kms']."</td>

                  <td align='center'>".$value['waiting']."</td>

                  <td align='center'>".$value['amount']."</td>

                  <td align='center'>".$value['cgst']."</td>

                  <td align='center'>".$value['sgst']."</td>

                  <td align='center'>".$value['toll']."</td>

                  <td align='center'>".$value['parking']."</td>

                  <td align='center'>".$value['invoice_sent']."</td>

                  <td align='center'>".$value['cash_received']."</td>

                  <td align='center'>".$value['total']."</td>

                  <td align='center'>".$value['grand_total']."</td>";

                  if($i==0)

                  {

                    $str .= "<td>".$tt."</td>";

                    $str .= "<td>".$remarks."</td>";

                    $str .= "<td align='center'>".$this->get_profit_loss($where,$_POST)."</td>";

                  }

                  else

                  {

                    $str .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";

                  }

          $str .="</tr>";

          $i++;

      }

      $str .= "</tbody>

              </table>";

      echo $str;

    }

    public function get_profit_loss($where='',$form='')

    {

      $fuel = 0;$ola = 0;$maintain = 0;$misc = 0;

      if(isset($form['fuel']) && $form['fuel']!='')

        $fuel = $form['fuel'];

      if(isset($form['ola_clients']) && $form['ola_clients']!='')

        $ola = $form['ola_clients'];

      if(isset($form['maintainence']) && $form['maintainence']!='')

        $maintain = $form['maintainence'];

      if(isset($form['driver_salary']) && $form['driver_salary']!='')

        $driver_sal = $form['driver_salary'];

      if(isset($form['miscallenous']) && $form['miscallenous']!='')

        $misc = $form['miscallenous'];      

      $amt = $this->taxi_model->get_profit_loss($where);

      return $amt['amt'] - $fuel - $ola - $maintain - $misc;

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
    function delete($del_id)
    {
      $access_data = $this->taxi_model->get_where(array("id"=>$del_id),'id')->row_array();     
      $output=array();
      if(count($access_data) > 0)
      {
        $this->taxi_model->delete(array("id"=>$del_id));
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
}

?>

