<?php

class HostModel extends CI_Model {

    protected $table = 'host';

    public function __construct() {

        parent::__construct();
        
    }

    public function get_host($host_id = null)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($host_id != null)
        {
            $this->db->where('host_id', $host_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 


    public function insert_host($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_host($host_id,$data)
    { 
        $this->db->set('last_update', 'now()', false);
        $this->db->where('host_id', $host_id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function delete_host($host_id)
    {
        $this->db->where('host_id', $host_id);
        $this->db->delete($this->table); 
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}

?>