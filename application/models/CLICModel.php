<?php

class CLICModel extends CI_Model {

    protected $table = 'clic';

    public function __construct() {
        parent::__construct();
    }

    public function get_clic($clic_name = null)
    {
        $this->db->select('cli.clic_name,srv.port,cli.protocol,srv.tunnel_type,cli.tunnel_name,cli.remote_peer,srv.authentication,srv.cipher,srv.tunnel_network,cli.local_network as cli_local_network,srv.srvc_name,srv.local_network as srv_local_network');
        
        if ($clic_name != null)
        {
            $this->db->where('clic_name', $clic_name);
        }
        
        $this->db->from('clic cli');
        $this->db->join('srvc srv','cli.srvc_name = srv.srvc_name');

        $query = $this->db->get();
        return $query->result_array(); 
    } 

    public function is_clic_exist($clic_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('clic_name', $clic_name);

        $query = $this->db->get();

        if($query->num_rows() != 0){
            return $query->result_array();
        }else{
            return False;
        }
    }

    public function insert_clic($data)
    {
        $this->db->set('last_update', 'now()', false);
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    public function update_clic($clic_name,$data)
    {
        $this->db->set('last_update', 'now()', false);
        $this->db->where('clic_name', $clic_name);
        $update = $this->db->update($this->table, $data);
        return $update;
    }
  
    public function delete_clic($clic_name)
    {
        $this->db->where('clic_name', $clic_name);
        $this->db->delete($this->table); 
    }

    public function __destruct() {  
        $this->db->close();  
    } 
}