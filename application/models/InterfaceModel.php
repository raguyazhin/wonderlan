<?php

class InterfaceModel extends CI_Model {

    protected $table = 'interface';

    public function __construct() {
        parent::__construct();
    }

    public function get_interface($interface_id = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($interface_id != null)
        {
            $this->db->where('interface_id', $interface_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 

    public function is_interface_exist($name)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('name', $name);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return False;
        }
    }


    public function insert_interface($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_interface($interface_id,$data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('interface_id', $interface_id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function delete_interface($interface_id)
    {
        $this->db->where('interface_id', $interface_id);
        $this->db->delete($this->table); 
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}
