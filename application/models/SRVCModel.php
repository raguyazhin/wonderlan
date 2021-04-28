<?php

class SRVCModel extends CI_Model {

    protected $table = 'srvc';

    public function __construct() {
        parent::__construct();
    }

    public function get_srvc($srvc_name = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($srvc_name != null)
        {
            $this->db->where('srvc_name', $srvc_name);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 

    public function is_srvc_exist($srvc_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('srvc_name', $srvc_name);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return False;
        }
    }

    public function insert_srvc($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_srvc($srvc_name,$data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('srvc_name', $srvc_name);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function delete_srvc($srvc_name)
    {
        $this->db->where('srvc_name', $srvc_name);
        $this->db->delete($this->table); 
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}
