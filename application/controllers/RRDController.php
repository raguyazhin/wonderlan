<?php

class RRDController extends CI_Controller {

    public function __construct()
    {
        
        parent::__construct();

              
	}

    
    function index()
    {
        $this->load->library('rrd');
        #data_dir must be writeable by web browser
        $data_dir='/var/lib/collectd/rrd/sdnserver/interface-enp3s0/';
        $rrd_file=$data_dir.'if_octets.rrd';
        $rrd_graph_path='/var/www/html/wonder/rrd_graph/';
        $rrd_graph_path_cpu='/var/www/html/wonder/rrd_graph/cpu-0/';

        #create graph images
        #echo $data_dir;
        $this->rrd->create_image($rrd_file, $rrd_graph_path.'day_graph.png', '1d');
        $this->rrd->create_image($rrd_file, $rrd_graph_path.'week_graph.png', '1w');
        $this->rrd->create_image($rrd_file, $rrd_graph_path.'month_graph.png', '1m');
        $this->rrd->create_image($rrd_file, $rrd_graph_path.'year_graph.png', '1y');

        $this->rrd->create_image('/var/lib/collectd/rrd/sdnserver/cpu-0/percent-system.rrd', $rrd_graph_path_cpu.'day_graph.png', '1d','cpu');
        $this->rrd->create_image('/var/lib/collectd/rrd/sdnserver/cpu-0/percent-system.rrd', $rrd_graph_path_cpu.'week_graph.png', '1w','cpu');
        $this->rrd->create_image('/var/lib/collectd/rrd/sdnserver/cpu-0/percent-system.rrd', $rrd_graph_path_cpu.'month_graph.png', '1m','cpu');
        $this->rrd->create_image('/var/lib/collectd/rrd/sdnserver/cpu-0/percent-system.rrd', $rrd_graph_path_cpu.'year_graph.png', '1y','cpu');
        
        
        #display graph images
        print '<div style="text-align: center;">';
        print '<h3>Day</h3><img src="'. base_url() . '/rrd_graph/'.'day_graph.png"></img><br>';
        print '<h3>Week</h3><img src="'. base_url() . '/rrd_graph/'.'week_graph.png"></img><br>';
        print '<h3>Month</h3><img src="'. base_url() . '/rrd_graph/'.'month_graph.png"></img><br>';
        print '<h3>Year</h3><img src="'. base_url() . '/rrd_graph/'.'year_graph.png"></img><br>';
        print '</div>';

        print '<div style="text-align: center;">';
        print '<h3>Day</h3><img src="'. base_url() . 'rrd_graph/cpu-0/'.'day_graph.png"></img><br>';
        print '<h3>Week</h3><img src="'. base_url() . 'rrd_graph/cpu-0/'.'week_graph.png"></img><br>';
        print '<h3>Month</h3><img src="'. base_url() . 'rrd_graph/cpu-0/'.'month_graph.png"></img><br>';
        print '<h3>Year</h3><img src="'. base_url() . 'rrd_graph/cpu-0/'.'year_graph.png"></img><br>';
        print '</div>';
    }
        
    function insert_data($input, $output)
    {
        $this->load->library('rrd');
        #data_dir must be writeable by web browser
        $data_dir='/var/www/test/';
        $rrd_file=$data_dir.'data.rrd';
        
        #if rrd file doesn't exist create one
        if (!file_exists($rrd_file)) $this->rrd->create($rrd_file);
        $this->rrd->update($rrd_file, array($input, $output));
    }

}