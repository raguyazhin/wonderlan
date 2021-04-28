<?php

class UploadCLICModel extends CI_Model {

    protected $table = 'upload_clic';

    public function __construct() {
        parent::__construct();
    }

    public function get_upload_clic($clic_name = null,$srvc_name = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($clic_name != null)
        {
            $this->db->where('clic_name', $srvc_name);
        }

        if ($srvc_name != null)
        {
            $this->db->where('srvc_name', $srvc_name);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 

    public function is_upload_clic_exist($clic_name = null,$srvc_name = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('clic_name', $clic_name);
        $this->db->where('srvc_name', $srvc_name);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return False;
        }
    }
    
    public function get_next_ip_table_id()
    {
        $query = $this->db->query("select ifnull(max(ip_table_id),100) + 1 as next_ip_table_id from $this->table");
        return $query->result_array(); 
    }

    public function insert_upload_clic($data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->set('uploaded_on', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_upload_clic($clic_name,$srvc_name,$data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->set('uploaded_on', 'now()', false);
        
        $this->db->where('clic_name', $clic_name);
        $this->db->where('srvc_name', $srvc_name);

        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}
