<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Send_email_model extends CI_Model {
    
    
    function __construct()
    {
        parent::__construct();

       // $this->_table = 'bookings';
    }
    
   
	public function to_sending_email()
  {

    $this->db->select('bookings.inv_no,bookings.officer_name,bookings.checkin_date');
    $this->db->from('bookings'); 
    $this->db->where('date(`checkin_date`) >= date(now()-interval 30 day)');
    $where = '(checkout_date="" or invoice_link = "NULL")';
    $this->db->where($where);        
    $query = $this->db->get(); 
     return $query->result_array();

  }

   //  public function pending_list()
   // {
   //  $this->db->select('*');
   //  $this->db->from('bookings'); 
   //  $this->db->join('rank', 'rank.id=bookings.rank_id');
   //  $this->db->join('executives', 'executives.id=bookings.executive_id');
   //  $this->db->where('bookings.invoice_link',NULL);        
   //  $query = $this->db->get(); 
   //   return $query->result_array();
   //  }
   
  }
?>
