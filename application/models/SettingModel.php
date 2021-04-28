<?php

class SettingModel extends CI_Model {

    public function __construct() {

        parent::__construct();
        
    }

    public function get_host($host_id = null)
    {

        $this->db->select('*');
        $this->db->from('host');
      
        $query = $this->db->get();
        return $query->result_array(); 

    } 

    public function __destruct() {  
        $this->db->close();  
    } 
}

?>