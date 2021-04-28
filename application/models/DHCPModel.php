<?php

class DHCPModel extends CI_Model {

    protected $table = 'dhcp';

    public function __construct() {
        parent::__construct();
    }

    public function get_dhcp($interface_name = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($interface_name != null)
        {
            $this->db->where('interface_name', $interface_name);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 

    public function is_dhcp_exist($interface_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('interface_name', $interface_name);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return False;
        }
    }

    public function insert_dhcp($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_dhcp($interface_name,$data)
    { 
        $this->db->set('last_update', 'now()', false);
        $this->db->where('interface_name', $interface_name);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function delete_dhcp($interface_name)
    { 
        $this->db->where('interface_name', $interface_name);
        $update = $this->db->delete($this->table);
        return $update;
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}

?>