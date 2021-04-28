<?php

class RouteModel extends CI_Model {

    protected $table = 'route';

    public function __construct() {
        parent::__construct();
    }

    public function get_route($route_id = null)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ($route_id != null)
        {
            $this->db->where('route_id', $route_id);
        }
        
        $query = $this->db->get();
        return $query->result_array(); 
    } 


    public function insert_route($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}
