<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Booking_model extends App_model {
    
    
    function __construct()
    {
        parent::__construct();

        $this->_table = 'bookings';
    }
    
    function listing()
    {  
		
        $this->_fields = "a.*,cc.name as cost_centre, b.name as rank,c.name as executive,d.name as vessel,IF(a.checkin_date='1970-01-01','',CONCAT(a.checkin_date,' ',TIME_FORMAT(a.checkin_time,'%H:%i'))) as checkin_date,IF(a.checkout_date='1970-01-01','',CONCAT(a.checkout_date,' ',TIME_FORMAT(a.checkout_time,'%H:%i'))) as checkout_date,CONCAT(a.e_checkout_date,' ',TIME_FORMAT(a.e_checkout_time,'%H:%i')) as e_checkout_date,e.name as room,e.tariff,IF(a.officer_sign='','NO','NO') as officer_sign,IF(a.executive_sign='','NO','NO') as executive_sign";
        $this->db->from('bookings a');
        $this->db->join("rank b","a.rank_id=b.id",'left');
        $this->db->join("executives c","a.executive_id=c.id",'left');
        $this->db->join("vessels d","a.vessel_id=d.id",'left');
        $this->db->join("rooms e","a.room_id=e.id",'left');
        $this->db->join("cost_centre cc","a.cost_centre=cc.id",'left');
        // $this->db->join("rank b","a.rank_id=b.id");
        $this->db->group_by('a.id');
        foreach ($this->criteria as $key => $value)
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;
            switch ($key)
            {
                case 'po_no':
                    $this->db->like('a.'.$key, $value);
                break;
                case 'officer_name':
                    $this->db->like('a.'.$key, $value);
                break;
                case 'checkout_date_from':
                    $value = date('Y-m-d',strtotime($value));
                    $this->db->where('a.checkout_date>=', $value);
                break;
                case 'checkout_date_to':
                    $value = date('Y-m-d',strtotime($value));
                    $this->db->where('a.checkout_date<=', $value);
                break;
                case 'inv_no':
                    $this->db->like('a.'.$key, $value);
                break;
                case 'invoice_link':
                  if($value=="enable")
                    $this->db->where('a.'.$key.' IS NOT NULL');
                  else
                    $this->db->where('a.'.$key.' IS NULL');
                break;
                case 'status':
                    $this->db->where('a.'.$key, $value);
                break;
                case 'pdf_downloaded':
                    $this->db->where('a.'.$key, $value);
                break;
                case 'c.email':
                    $this->db->like($key, $value);
                break;               
            }
        }        
        return parent::listing();
    }
	
    public function get_bookings($where='',$table='')
    {
      if($where!='')
        $this->db->where($where);
      $this->db->select("a.*,b.name as rank,c.name as room,d.name as vessel,e.name as executives,f.address as address,TIME_FORMAT(a.checkin_time,'%H:%i') as checkin_time,TIME_FORMAT(a.checkout_time,'%H:%i') as checkout_time,TIME_FORMAT(a.e_checkout_time,'%H:%i') as e_checkout_time,c.tariff");
      $this->db->from("bookings a");
      $this->db->join("rank b","a.rank_id=b.id",'left');
      $this->db->join("rooms c","a.room_id=c.id",'left');
      $this->db->join("vessels d","a.vessel_id=d.id",'left');
      $this->db->join("executives e","a.executive_id=e.id",'left');
      $this->db->join("invoice_address f","a.inv_address_id=f.id",'left');
      $this->db->group_by("a.id");
      $q = $this->db->get();
      // echo $this->db->last_query();exit;
      return $q->row_array();
    }

    public function get_room_bookings($where='',$pdf_link='',$date='')
    {
      if($pdf_link!='' && $pdf_link=="enable")
        $this->db->where('a.invoice_link IS NOT NULL',NULL,false);
      if($where)
        $this->db->like($where);
      if($date)
        $this->db->where($date);
      $this->db->select("a.*,b.name as rank,c.name as executive,d.name as vessel,CONCAT(a.checkin_date,' ',TIME_FORMAT(a.checkin_time,'%H:%i')) as checkin_date,CONCAT(a.checkout_date,' ',TIME_FORMAT(a.checkout_time,'%H:%i')) as checkout_date,CONCAT(a.e_checkout_date,' ',TIME_FORMAT(a.e_checkout_time,'%H:%i')) as e_checkout_date,e.name as room,e.tariff");
      $this->db->from('bookings a');        
      $this->db->join("rank b","a.rank_id=b.id",'left');
      $this->db->join("executives c","a.executive_id=c.id",'left');
      $this->db->join("vessels d","a.vessel_id=d.id",'left');
      $this->db->join("rooms e","a.room_id=e.id",'left');
      $q = $this->db->get();
      // echo $this->db->last_query();
      return $q->result_array();
    }

    public function get_room_status()
    {
      $this->db->select("a.*,t.count,r.name as rank,IF(b.checkin_date='1970-01-01','',CONCAT(b.checkin_date,' ',TIME_FORMAT(b.checkin_time,'%H:%i'))) as checkin_date,b.occupancy,IF(b.e_checkout_date='0000-00-00','',CONCAT(b.e_checkout_date,' ',TIME_FORMAT(b.e_checkout_time,'%H:%i'))) as e_checkout_date,b.checked_in,b.officer_name,c.name as executive,b.checkout_date,b.checkout_time");
      $this->db->from('rooms a');
      $this->db->join("bookings b","b.room_id=a.id and and (b.checkout_date >= '".date('Y-m-d')."' OR b.checkout_date = '0000-00-00') and b.status !='Closed'","left");
      $this->db->join("executives c","b.executive_id=c.id","left");
      $this->db->join("rank r","b.rank_id=r.id",'left');
      $this->db->join("(SELECT r.id,count(r.id) as count FROM rooms r LEFT JOIN bookings b ON b.room_id=r.id and (b.checkout_date >= '".date('Y-m-d')."' OR b.checkout_date = '0000-00-00') and b.status !='Closed' GROUP BY r.id) t","t.id=a.id");
      $this->db->order_by('a.id ASC,b.id ASC');
      $q = $this->db->get();
      return $q->result_array();
    }



   public function pending_list()
   {
    $this->db->select('bookings.id,bookings.`inv_no`,bookings.`po_no`,bookings.`officer_name`,bookings.`rank_id`,bookings.`executive_id`,bookings.`purpose`,bookings.`course_name`,bookings.`vessel_id`,bookings.`checkin_date`,bookings.`checkout_date`,bookings.`checked_in`,bookings.`checkout_date`,bookings.`no_of_days`,bookings.`occupancy`,bookings.`room_id`,bookings.`cost_centre`,bookings.`discount`,bookings.`invoice_amount`,rank.name as rankname,executives.name as executivename,vessels.name as vesselname,rooms.name as roomname,cost_centre.name as costcentre');
    $this->db->from('bookings'); 
    $this->db->join('rank', 'rank.id=bookings.rank_id');
    $this->db->join('executives', 'executives.id=bookings.executive_id');
    $this->db->join('vessels', 'vessels.id=bookings.vessel_id');
    $this->db->join('rooms', 'rooms.id=bookings.room_id');
    $this->db->join('cost_centre', 'cost_centre.id=bookings.cost_centre');
    $this->db->where('bookings.invoice_link',NULL);        
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
