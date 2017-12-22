<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



require_once('App_model.php');



class Taxi_model extends App_model {

    

    

    function __construct()

    {

        parent::__construct();



        $this->_table = 'taxi_booking';

    }

    

    function listing()

    {		

      $this->_fields = "a.*,cc.name as cost_centre,b.name as rank,d.name as vessel,c.name as from_loc,e.name as to_loc";

      $this->db->from('taxi_booking a');

      $this->db->join("rank b","a.rank=b.id");

      $this->db->join("locations c","a.from_loc=c.id");

      $this->db->join("vessels d","a.vessel=d.id");

      $this->db->join("locations e","a.to_loc=e.id");

      $this->db->join("cost_centre cc","a.cost_centre=cc.id","left");

      $this->db->group_by('a.id');

      foreach ($this->criteria as $key => $value)

      {

        if( !is_array($value) && strcmp($value, '') === 0 )

          continue;

        switch ($key)

        {

          case 'driver_name':

            $this->db->like('a.'.$key, $value);

          break;

          case 'officer_name':

            $this->db->like('a.'.$key, $value);

          break;

          case 'from_date':

            $this->db->where('a.date>=', date("Y-m-d",strtotime($value)));

          break;

          case 'to_date':

            $this->db->where('a.date<=', date("Y-m-d",strtotime($value)));

          break;

          case 'trip_sheet':

            $this->db->where('a.trip_sheet', $value);

          break;

          case 'inv_no':

            $this->db->like('a.'.$key, $value);

          break;           

        }

      }        

      return parent::listing();

    }

	

    public function get_bookings($where='',$table='')

    {

      $this->db->where($where);

      $this->db->select("a.*,a.amount as charge,e.address");

      $this->db->from("taxi_booking a");

      $this->db->join("rank b","a.rank=b.id","left");

      $this->db->join("vessels d","a.vessel=d.id","left");
      $this->db->join("invoice_address e","a.inv_address=e.id","left");

      $this->db->group_by("a.id");

      $q = $this->db->get();

      return $q->row_array();

    }



    public function get_all_bookings($where)

    {  

        $this->db->where($where);

        $this->db->select("a.*,b.name as rank,d.name as vessel,c.name as from_loc,e.name as to_loc");

        $this->db->from('taxi_booking a');

        $this->db->join("rank b","a.rank=b.id");

        $this->db->join("locations c","a.from_loc=c.id");

        $this->db->join("vessels d","a.vessel=d.id");

        $this->db->join("locations e","a.to_loc=e.id");

        $this->db->group_by('a.id');

        $q = $this->db->get();

        return $q->result_array();

    }



    public function get_charge($where='',$table='')

    {

      if($where!='')

        $this->db->where($where);

      $q = $this->db->get($table);

      return $q->row_array();

    }

    public function get_profit_loss($where='',$table='')

    {

      if($where!='')

        $this->db->where($where);

      $q = $this->db->query("SELECT (sum(`grand_total`) - (sum(toll) + sum(parking) + sum(cgst) + sum(sgst))) as amt FROM `taxi_booking`");

      return $q->row_array();

    }


  public function to_check()
  {
    $this->db->select('id,inv_no');
    $this->db->from('taxi_booking');
    $this->db->order_by('id', 'DESC');
    $this->db->limit('1');
    $query = $this->db->get(); 
   return $query->row();
  }

    

}

?>

