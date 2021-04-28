<?php

class DashboardModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }




    public function __destruct() {  
        $this->db->close();  
    } 
    
}

?>