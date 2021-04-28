<?php

class NatModel extends CI_Model {

    protected $table = 'ca';

    public function __construct() {
        parent::__construct();
    }

    public function get_ca($ca_id = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($ca_id != null)
        {
            $this->db->where('ca_id', $ca_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 


    public function insert_ca($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}
