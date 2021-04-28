<?php

class EIGRPModel extends CI_Model {

    protected $table = 'eigrp';

    public function __construct() {
        parent::__construct();
    }

    public function get_eigrp($local_as = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($local_as != null)
        {
            $this->db->where('local_as', $local_as);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 

    public function is_eigrp_exist($local_as)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('local_as', $local_as);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return False;
        }
    }

    public function insert_eigrp($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_eigrp($local_as,$data)
    { 
        $this->db->set('last_update', 'now()', false);
        $this->db->where('local_as', $local_as);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function delete_eigrp($local_as)
    { 
        $this->db->where('local_as', $local_as);
        $update = $this->db->delete($this->table);
        return $update;
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}

?>