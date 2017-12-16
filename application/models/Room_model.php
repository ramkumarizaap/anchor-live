<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Room_model extends App_model {
    
    
    function __construct()
    {
        parent::__construct();
    }
    
     function listing()
    {  
	  $this->_fields = "a.*,t.count,r.name as rank,IF(b.checkin_date='1970-01-01','',CONCAT(b.checkin_date,' ',TIME_FORMAT(b.checkin_time,'%H:%i'))) as checkin_date,b.occupancy,CONCAT(b.e_checkout_date,' ',TIME_FORMAT(b.e_checkout_time,'%H:%i')) as e_checkout_date,b.checked_in,b.officer_name,c.name as executive,b.checkout_date,b.checkout_time";
      $this->db->from('rooms a');
      $this->db->join("bookings b","b.room_id=a.id and (b.checkout_date >= '".date('Y-m-d')."' OR b.checkout_date = '0000-00-00') and b.status !='Closed'","left");
      $this->db->join("executives c","b.executive_id=c.id","left");
      $this->db->join("rank r","b.rank_id=r.id",'left');
      $this->db->join("(SELECT r.id,count(r.id) as count FROM rooms r LEFT JOIN bookings b ON b.room_id=r.id and (b.checkout_date >= '".date('Y-m-d')."' OR b.checkout_date = '0000-00-00') and b.status !='Closed' GROUP BY r.id) t","t.id=a.id");
      //$this->db->group_by("a.id");
      $this->db->order_by('a.id ASC,b.id ASC');
  
      
        return parent::listing();
    }

    function get_employee_details($id){

        $this->db->select('e.*,d.*,n.*');
        $this->db->from('employee e');
        $this->db->join('employee_details d','e.id=d.emp_id');
        $this->db->join('employee_note n','e.id=n.emp_id');
        $this->db->where('e.id',$id);
        $this->db->group_by('e.id');
        $result = $this->db->get()->row_array();

        return $result;
    }

     function get_report(){

        $this->db->select('e.*,d.*,n.*,o.name as org_name');

        $this->db->from('employee e');
        $this->db->join("employee_details d","e.id=d.emp_id");
        $this->db->join("employee_note n","e.id=n.emp_id");
        $this->db->join("organization o","e.org_id=o.id");

        $this->db->group_by("e.id");
        $this->db->order_by("e.emp_name",'asc');

        return $this->db->get()->result_array();
    }
	
    
}
?>
