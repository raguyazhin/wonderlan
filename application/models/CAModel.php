<?php

class CAModel extends CI_Model {

    protected $table = 'ca';

    public function __construct() {

        parent::__construct();
        
    }

    public function get_ca($ca_name = null)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($ca_name != null)
        {
            $this->db->where('ca_name', $ca_name);
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

    public function update_ca($ca_name,$data)
    { 
        $this->db->set('last_update', 'now()', false);
        $this->db->where('ca_name', $ca_name);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function delete_ca($ca_name)
    {
        $this->db->where('ca_name', $ca_name);
        $this->db->delete($this->table); 
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}

?>