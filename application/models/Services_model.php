<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');



require_once('App_model.php');



class Services_model extends App_model {

    

    

    function __construct()

    {

      parent::__construct();

    }

    

    function executives()

    {

    	$this->_fields = "*";

      $this->db->from('executives');

      return parent::listing();

    }

    function rank()

    {

    	$this->_fields = "*";

      $this->db->from('rank');

      return parent::listing();

    }

    function vessels()

    {

    	$this->_fields = "*";

      $this->db->from('vessels');

      return parent::listing();

    }

    function rooms()

    {

    	$this->_fields = "*";

      $this->db->from('rooms');
      // $this->db->order_by('pos_id ASC');
      return parent::listing();

    }

     function inv_address()

    {

    	$this->_fields = "*";

      $this->db->from('invoice_address');

      return parent::listing();

    }

     function purpose()

    {

    	$this->_fields = "*";

      $this->db->from('purpose');

      return parent::listing();

    }

     function cost_centre()

    {

      $this->_fields = "*";

      $this->db->from('cost_centre');

      return parent::listing();

    }



    function get_services($where='',$table='')

    {

    	if($where)

    		$this->db->where($where);

      $q = $this->db->get($table);

      return $q->row_array();

    }

    function select_id()
    {
    $this->db->select('id');
    $this->db->from('rooms');       
    $query = $this->db->get(); 
    return $query->result_array();
    }


  }

?>