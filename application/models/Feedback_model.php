<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Feedback_model extends App_model {
    
    
    function __construct()
    {
        parent::__construct();
        // $this->_table = 'feedback';
    }
    
     function listing()
    {  
      $this->_fields = "a.*,b.name as room_id";
      $this->db->from("feedback a");
      $this->db->join("rooms b","a.room_id=b.id");
      $this->db->group_by("a.id");
      // $this->db->get();
      return parent::listing();
    }
    
}
?>
