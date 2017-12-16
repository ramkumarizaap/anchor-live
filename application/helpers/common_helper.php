<?php

function is_logged_in()
{
    $CI = get_instance();
    
    $user_data = get_user_data();
    
    if( is_array($user_data) && $user_data )
        return TRUE;

    return FALSE;

}

function get_current_user_id()
{
    $CI = & get_instance();
    
    $current_user = get_user_data();
    
    if(!empty($current_user)) {
        return $current_user['id'];
    }
}
function get_user_data()
{
    $CI = get_instance();
    
        
    if($CI->session->userdata('user_data'))
    {
        return $CI->session->userdata('user_data');
    }
    else
    {
        return FALSE;
    }
}

function get_ajax_row_id($where='',$table='')
{
    $CI = & get_instance();
    $CI->db->where($where);
    $result = $CI->db->get($table)->row_array();
    return $result['id'];
}

function get_user_role( $user_id = 0 )
{
    $CI= & get_instance();
    
    if(!$user_id) 
    {
        $user_data = get_user_data();
        return $user_data['role'];
    }   
    
    $CI->load->model('user_model');
    $row = $CI->user_model->get_where(array('id' => $user_id))->row_array;

    if( !$row )
        return FALSE;

    return $row['role'];
}

function get_roles()
{
    $CI = & get_instance();
    $CI->load->model('role_model');
    $records = $CI->role_model->get_roles();

    $roles = array();
    foreach ($records as $id => $val) 
    {
        $roles[$id] = $val;
    }

    return $roles;
}

function display_flashmsg($flash){

    if(!$flash)
        return FALSE;

    $status = $msg = '';

    if(isset($flash['success_msg'])){
        $status = 'success';
        $msg = $flash['success_msg'];
    }

    if(isset($flash['error_msg'])){
        $status = 'danger';
        $msg = $flash['error_msg'];
    }

    if($status && $msg){
        $str = '<div id="div_service_message" class="alert alert-'.$status.' alert-dismissible">';
        $str.= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
        
        if($status == 'danger')
            $status = 'error';
        $str.='<strong>'.ucfirst($status).':&nbsp;</strong> '. strip_tags($msg) .' </div>';

        echo $str;
    }

}


function displayData($data = null, $type = 'string', $row = array(), $wrap_tag_open = '', $wrap_tag_close = '')
{
     $CI = & get_instance();
     
    if($data=='' || is_null($data) || is_array($data) || (strcmp($data, '') === 0 && !count($row)) )
        return $data;
    
    switch ($type)
    {
        case 'string':
            break;
        case 'humanize':
        $CI->load->helper("inflector");
            $data = humanize($data);
            break;
        case 'date':
            if($data!='0000-00-00 00:00')
               $data =  str2USDT($data);
            else
                $data = "";
            break;
        case 'datetime':
            if($data!='0000-00-00 00:00')
                $data = str2USDate($data);
            else
                $data = "";
            break;
        case 'money':
            $data = number_format((float)$data, 2);
            break;
        case 'mailto':
            $data = '<a href="mailto:'.$data.'">'.$data.'</a>';
            break;
        case 'formated_number':
            $data = number_format((float)$data, 2);
            break;
        case 'link':
            $data = '<a href="'.$data.'" target="_blank">Invoice</a>';
            break;
        case 'word_money':
            $data = convert_number($data)." Rupees only";
        break;
         case 'colorize':
            if($row['checked_in']=="Yes")
                $data = $data;
            else
                $data = "<span style=color:red>".date("Y-M-d H:i:s",strtotime($data))."</span>";
        break;

        case 'tablink':
            $data = '<a href="'.$data.'" target="_blank">'.$data.'</a>';
            break;
        case 'sign_link':
            $data = "<a href='javascript:void(0);' onclick='getSignature(".$row['id'].")'>Signature</a>";
        break;
        case 'label':
                if($data == 'Active')
                    $type = 'label-success';
                elseif($data == 'Deactive')
                    $type = 'label-danger';
                $data = '<label class="label '.$type.'">'.$data.'</label>';
                break;        
    }
    
    return $wrap_tag_open.$data.$wrap_tag_close;
}

function employee_status(){

    $status = array('Joined'=>'Joined','resigned'=>'resigned','vacation'=>'vacation','unpaid leave'=>'unpaid leave','Absconding'=>'Absconding');

    return $status;

}
function get_by_id($where='',$table='')
{
    $CI = & get_instance();
    if($where)
        $CI->db->where($where);
    $result = $CI->db->get($table)->row_array();
    $types = array();
    $types['name'] = $result['name'];
    return $types;
}

function get_executives()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('executives')->result_array();
    $types = array();$i=0;
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['name'];
        $i++;
    }
    return $types;
}
function get_rooms()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('rooms')->result_array();
    $types = array();$i=0;
    foreach ($result as $row)
    {
      $types[$row['id']] = $row['name'];
      $i++;
    }
    return $types;
}
function get_address()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('invoice_address')->result_array();
    $types = array();$i=0;
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['address'];
        $i++;
    }
    return $types;
}
function get_purpose()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('purpose')->result_array();
    $types = array();$i=0;
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['name'];
        $i++;
    }
    return $types;
}
function get_cost_centre()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('cost_centre')->result_array();
    $types = array();$i=0;
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['name'];
        $i++;
    }
    return $types;
}
function get_vessels()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('vessels')->result_array();
    $types = array();$i=0;
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['name'];
        $i++;
    }
    return $types;
}
function get_ranks()
{
    $CI = & get_instance();
    $CI->db->where("status","Active");
    $result = $CI->db->get('rank')->result_array();
    $types = array();
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['name'];
    }
    return $types;
}

function get_locations()
{
    $CI = & get_instance();
    $result = $CI->db->get('locations')->result_array();
    $types = array();
    foreach ($result as $row) 
    {
        $types[$row['id']] = $row['name'];
    }
    return $types;
}

function get_taxilocation($id)
{
    $CI = & get_instance();
    $result = $CI->db->get('locations')->result_array();
    $name = "";
    foreach ($result as $row) 
    {
        if($id == $row['id'])
          $name = $row['name'];
    }
    return $name;
}

function getDayFromString( $day_str )
{
    return date('Y-m-d',strtotime( $day_str ));
}

function getStayedDays( $check_in, $check_out )
{
    $days = ceil(abs(strtotime(getDayFromString($check_out).' 11:59:59') - strtotime(getDayFromString($check_in).' 12:00:00'))/ (60*60*24) );

    $is_same_day = ( getDayFromString($check_in) === getDayFromString($check_out) );

    if(date('H',strtotime( $check_in )) < 8)
        $days += 1;

    if( !$is_same_day && date('H',strtotime( $check_out )) > 16)
        $days += 1;

    return $days;

}

function get_invoicenum($table = 'bookings'){

    $CI = & get_instance();
    $row = $CI->db->query("SELECT auto_increment FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'anchor-new' AND TABLE_NAME = '".$table."'")->row(); 
    
    if (date('m')>3)
        $fyear = date('y').(date('y')+1);
    else 
        $fyear = (date('y')-1).date('y');

    $invnum = "AP".$fyear."-".$row->auto_increment;

    return $invnum;
}

function get_projects()
{
    $CI = & get_instance();
    $result = $CI->db->get('projects')->result_array();

    $proj = array();
    foreach ($result as $row) 
    {
        $proj[$row['id']] = $row['name'];
    }

    return $proj;
}

function get_employees($org = '')
{
    $CI = & get_instance();

    $CI->db->select('id,emp_code,emp_name');
    if($org)
        $CI->db->where('org_id',$org);

    $CI->db->order_by('emp_name','ASC');    
    $result = $CI->db->get('employee')->result_array();

    $emp = array();
    foreach ($result as $row) 
    {
        $emp[$row['emp_code']] = $row['emp_name'];
    }

    return $emp;
}

function check_is_working_day($date){

    $day = date('l',strtotime($date));

    $CI = & get_instance();

    $CI->db->where('status',1);

    $result = $CI->db->get('working_days')->result_array();

    foreach ($result as $row) 
    {
        if(strtolower($row['name']) == strtolower($day))
            return TRUE;
    }

    return FALSE;
}

function str2USDate($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
         return NULL;
    return date("Y-M-d H:i:s", $intTime);
}

function str2USDT($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
         return NULL;
    return date("Y-M-d", $intTime);
}

    // no logic for server time to local time.
function str2DBDT($str=null)
{
    $intTime = (!empty($str))?strtotime($str):time();
    if ($intTime === false)
         return NULL;
    return date("Y-M-d H:i:s", $intTime);
}

function str2DBDate($str)
{
    $intTime = strtotime($str);
    if ($intTime === false)
        return NULL;
    return date("Y-M-d",$intTime);
}

function addDayswithdate($date,$days){

    $date = strtotime("+".$days." days", strtotime($date));
    return  date("Y-M-d", $date);

}

function day_to_text($date) {
    
    $day_no = date("N",strtotime($date));
    
    $day_array = array(1 => "Monday" , 2 => "Tuesday" , 3 => "Wednesday" , 4 => "Thursday" , 5 => "Friday" , 6 => "Saturday" , 7 => "Sunday"  );
    
    return $day_array[$day_no];
}


function date_ranges($case = '')
{
    $dt = date('Y-m-d');
    if(empty($case)){
        return false;
    }

    switch($case)
    {
        case 'today':
            $highdateval = $dt;
            $lowdateval = $dt;
        break;
        case 'thisweek':
            $highdateval = date('Y-m-d', strtotime('saturday this week'));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thisweektodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thismonth':
            $highdateval = date('Y-m-d', strtotime('last day of this month'));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thismonthtodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thisyear':
            $highdateval = date('Y-m-d', strtotime('1/1 next year -1 day'));
            $lowdateval  = date('Y-m-d ', strtotime('1/1 this year'));
        break;
        case 'thisyeartodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('1/1 this year'));
        break;
        case 'thisquarter':
        $quarters = array();
        $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
        $quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
        $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
        $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
        $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
        $cur_month = (int) date("m",strtotime($dt));
       
        
        $date_range = $quarters[$cur_month];
        $highdateval = $date_range['end_date'];
        $lowdateval  = $date_range['start_date'];
        break;
        case 'yesterday':
            $highdateval = date('Y-m-d', strtotime('yesterday'));
            $lowdateval  = date('Y-m-d', strtotime('yesterday'));
        break;
        case 'recent':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-4,date("Y")));
        break;
        case 'lastweek':
            $highdateval = date('Y-m-d', strtotime('saturday last week'));
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastweektodate':
            if(date('l')=="Sunday")
            {
                $highdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
            }
            else
            {
                //$lastweek = date('l').' last week';
                $highdateval = date('Y-m-d');
            }
            
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last day of last month'));
        break;
        case 'lastmonthtodate';
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last month'));
        break;
        case 'lastquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('1/1 this year -1 day')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
            break;
        case 'lastquatertodate':
            $quarters = array();
            $todaydate = date('d',strtotime($dt));
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('10/'.$todaydate.' last year')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('1/'.$todaydate.' this year')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('4/'.$todaydate.' this year')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('7/'.$todaydate.' this year')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'lastyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d', strtotime('1/1 this year -1 day'));
        break;
        case 'lastyeartodate':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d');
        break;
        case 'since30days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-31,date("Y")));
        break;
        case 'since60days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-61,date("Y")));
        break;
        case 'since90days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-91,date("Y")));
        break;
        case 'since350days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-351,date("Y")));
        break;
        case 'nextweek':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('next week saturday'));
        break;
        case 'nextfourweeks':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('+4 weeks Saturday'));
        break;
        case 'nextmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of next month'));
            $highdateval = date('Y-m-d', strtotime('last day of next month'));
        break;
        case 'nextquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 next year'));
            //$quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
             $quarters[01] = $quarters[02] = $quarters[03]= array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
             $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09]  = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 next year - 1 day')));
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'nextyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 next year'));
            $highdateval = date('Y-m-d', strtotime('12/31 next year'));
        break;
        }

        return array('highdateval' => $highdateval, 'lowdateval' => $lowdateval);
   }
   
   
function update_usermeta($key = '',$value = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
    
    $data = $return_data = array();
    $data['meta_value'] = $value;
    $data['updated_id'] = getAdminUserId();
    $data['updated_time'] = date('Y-m-d', local_to_gmt());
    
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
        $return_data['prev_value'] = $meta_row_data['meta_value'];
        $CI->user_model->update(array('umeta_id' => $meta_row_data['umeta_id']),$data,'usermeta');
        $return_data['id'] = $meta_row_data['umeta_id'];
        $return_data['status'] =  "update";
        
    }
    else
    {
        $data['meta_key'] = $key;
        $data['user_id'] = $user_id;
        $data['created_id'] = getAdminUserId();
        $data['created_time'] = date('Y-m-d', local_to_gmt());
        $umeta_id = $CI->user_model->insert($data,'usermeta');
        $return_data['id'] = $umeta_id;
        $return_data['status'] =  "add";
    }
    
    return $return_data;
    
}


function get_usermeta($key = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
      
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
    
        return $meta_row_data['meta_value'];
    }
    else
    {
        return false;
    }
}



function xml_obj_to_array($xml_obj) {
        
            $json = json_encode($xml_obj,TRUE);
            $arr = json_decode($json,TRUE);
        
        return $arr;                     
}



function site_traffic()
{
    $CI = & get_instance();
    
    
}


function actionLogAdd($type,$id = NULL, $action)
{
    $CI = & get_instance();
    $CI->load->model('log_model');
    $CI->log_model->add($type,$id,$action);
}

function is_valid_product($product_id = 0)
{
    $CI->db->load->model('product_model');

    $result = $CI->db->product_model->get_where(array('id' => $product_id));

    return $result->num_rows()?TRUE:FALSE;
}

function is_valid_user($user_id = 0)
{
    $CI->db->load->model('user_model');

    $result = $CI->db->user_model->get_where(array('id' => $user_id));

    return $result->num_rows()?TRUE:FALSE;
}

function get_working_days($year = '', $month = '')
{
  if ($year == '')
    $year = date('Y');
  if ($month == '')
    $month = date('m');
  $startdate = strtotime($year . '-' . $month . '-01');
  $enddate = strtotime('+' . (date('t',$startdate) - 1). ' days',$startdate);
  $currentdate = $startdate;
  $return = intval((date('t',$startdate)),10);
  while ($currentdate <= $enddate)
  {
    if ((date('D',$currentdate) == 'Fri'))
    {
      $return = $return - 1;
    }
    $currentdate = strtotime('+1 day', $currentdate);
  }
  return $return;
}

function get_employee_details($emp_id='')
{
  $CI = & get_instance();
  $CI->load->model('reports_model');
  $result = $CI->reports_model->get_employee_details($emp_id);
  return $result;
}

function convert_number($number)
{
    if (($number < 0) || ($number > 999999999))
    {
      throw new Exception("Number is out of range");
    }
    
    // exit;
    $Gn = floor($number / 1000000);
    /* Millions (giga) */
    $number -= $Gn * 1000000;
    $kn = floor($number / 1000);
    /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);
    /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);
    /* Tens (deca) */
    $n = $number % 10;
    /* Ones */
    $res = "";
    if ($Gn) {
      $res .= convert_number($Gn) .  "Million";
    }
    if ($kn) {
      $res .= (empty($res) ? "" : " ") .convert_number($kn) . " Thousand";
    }
    if ($Hn) {
      $res .= (empty($res) ? "" : " ") .convert_number($Hn) . " Hundred";
    }
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
    if ($Dn || $n) {
      if (!empty($res)) {
        $res .= " and ";
      }
      if ($Dn < 2) {
        $res .= $ones[$Dn * 10 + $n];
      } else {
        $res .= $tens[$Dn];
        if ($n) {
          $res .= " " . $ones[$n];
        }
      }
    }

    if (empty($res))
    {
      $res = "zero";
    }
   
   return $res;
  }

  function convert_to_paise($number)
  {
    $len = strlen(substr(strrchr($number, "."), 1));
    $dec = substr($number,-2);
    $decimal_words = "Only";
    if($len>1)
    {
      $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
      $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
      if($dec > 19)
      {
        $dec1 = substr($dec, -2);
        $decimal1 = substr($dec1,0,1);
        $decimal2 = substr($dec1,1,2);
        $decimal_words = " and ".$tens[$decimal1]." ".$ones[$decimal2]." cents Only";
      }
      else
      {
        if($len>1)
          $dec1 = substr($dec, -2);
        else
          $dec1 = substr($dec, -1);
        $decimal_words = " and ".$ones[$dec1]." cents Only";
      }
    }
    return $decimal_words;
  }

  function get_hourly_rate($emp_id,$date='')
  {
    $date = explode("|", $date);
    $CI = & get_instance();
    $CI->load->model('reports_model');
    $total_working_days = get_working_days_by_date($date[0],$date[1]);
    $total_hours_in_month = $total_working_days * 8;
    $emp_code = get_employee_details($emp_id)['emp_code'];
    $total_hours = $CI->reports_model->get_total_working_hours_by_date($emp_code,$date[0],$date[1]);
    $not = $CI->reports_model->get_normal_ot_by_date($emp_code,$date[0],$date[1]);
    $fot = $CI->reports_model->get_friday_ot_by_date($emp_code,$date[0],$date[1]);
    $total_working_hours = $total_hours - ($not + $fot);
    $basic_salary = get_employee_details($emp_id)['basic_salary'];
    return $hourly_rate = number_format(($basic_salary / $total_working_days) / 8,2);
  }

function get_working_days_by_date($startDate, $endDate)
{
    $workingDays = 0;
    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate);
    for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24))
    {
        if (date("D", $i) != "Fri") $workingDays = $workingDays + 1;
    }
    return $workingDays;
}


?>
