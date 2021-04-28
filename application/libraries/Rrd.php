<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Rrd Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Rrd
 * @author		Petar Juros (petar.juros@gmail.com)
 * @link		http://petar.juros.hr
 */
class Rrd {

	/**
	 * Create rrd file
	 *
	 * @access	public
	 * @param	string	name and full path of rrd file to create
	 * @param	string	type of rrd file
	 * @return	bool  	success status
	 */
	function create($name, $type='traffic')
	{
		switch ($type) {
    		case 'traffic':
    			$opts = array("--step", "300",
					"DS:traffic_in:DERIVE:600:0:U",
					"DS:traffic_out:DERIVE:600:0:U",
					"RRA:AVERAGE:0.5:1:600", 
					"RRA:AVERAGE:0.5:6:700",
					"RRA:AVERAGE:0.5:24:775",
					"RRA:AVERAGE:0.5:288:797",
					"RRA:MIN:0.5:1:600",
					"RRA:MIN:0.5:6:700", 
					"RRA:MIN:0.5:24:775",
					"RRA:MIN:0.5:288:797",
					"RRA:MAX:0.5:1:600",
					"RRA:MAX:0.5:6:700",
					"RRA:MAX:0.5:24:775",
					"RRA:MAX:0.5:288:797", 
					"RRA:LAST:0.5:1:600",
					"RRA:LAST:0.5:6:700",
					"RRA:LAST:0.5:24:775",
					"RRA:LAST:0.5:288:797"
		        );
        		break;
		}
		
		$ret = rrd_create($name, $opts, count($opts));
		if ($ret==0) {
			$error = rrd_error();
			print $error;
		    return false;
		}
		else return true;	
	}

	// --------------------------------------------------------------------
	
	 /**
	 * Generate image from rrd file
	 *
	 * @param	string	name and full path to rrd file 
	 * @param	string	name and full path of image file to create (must end with .png)
	 * @param	string	time span to show in graph (1d, 1w, 1m, ...) 
	 * @param	string	type of rrd file
	 * @return	bool  	success status
	 */	
	function create_image($rrd_file, $image_file, $time='1d', $type='traffic')
	{
		switch ($type) {
    		case 'traffic':
				$opts = array("--imgformat=PNG", "--start=-".$time, "--end=-300", "--title=Traffic graph",
						"--rigid", "--base=1000", "--height=120", "--width=500",
			        	"--alt-autoscale-max", "--lower-limit=0", "--vertical-label=bits per second", "--slope-mode",
						"DEF:a=".$rrd_file.":rx:AVERAGE",
						"DEF:b=".$rrd_file.":tx:AVERAGE",
						"CDEF:cdefa=a,8,*",
						"CDEF:cdefe=b,8,*",
						"AREA:cdefa#00E600: Inbound",
						"GPRINT:cdefa:LAST:Current\\:%8.2lf %s",
						"GPRINT:cdefa:AVERAGE:Average\\:%8.2lf %s",
						"GPRINT:cdefa:MAX:Maximum\\:%8.2lf %s\\n",
						"AREA:cdefe#002A97:Outbound",
						"GPRINT:cdefe:LAST:Current\\:%8.2lf %s",
						"GPRINT:cdefe:AVERAGE:Average\\:%8.2lf %s",
						"GPRINT:cdefe:MAX:Maximum\\:%8.2lf %s\\n"
					);

			case 'cpu':
					$opts = array("--imgformat=PNG", "--start=-".$time, "--end=-300", "--title=CPU Utilization",
							"--rigid", "--base=1000", "--height=120", "--width=500",
							"--alt-autoscale-max", "--lower-limit=0", "--vertical-label=percent", "--slope-mode",
							"DEF:a=".$rrd_file.":value:AVERAGE",
							"AREA:a#00E600: CPU Utilization",
							"GPRINT:a:LAST:Current\\:%8.0lf %s",
							"GPRINT:a:AVERAGE:Average\\:%8.0lf %s",
							"GPRINT:a:MAX:Maximum\\:%8.0lf %s\\n",
						);

        	break;
		}

		print_r($opts);
		//$ret = rrd_graph($image_file, $opts, count($opts));
		$ret = rrd_graph($image_file, $opts);

		if (!is_array($ret)) {
			$error = rrd_error();
			print $error;
			return false;
		}
		else return true;
	}

	// --------------------------------------------------------------------
	
	 /**
	 * Update rrd file with data
	 *
	 * @param	string	name and full path to rrd file 
	 * @param	array	array of values to insert in rrd file
	 * @return	bool  	success status
	 */	
	function update($rrd_file, $values)
	{
		$input_string="N";
		foreach ($values as $value) $input_string.=":".$value;
		$ret = rrd_update($rrd_file, $input_string);
		if ($ret==0) {
			$error = rrd_error();
		    print $error;
		    return false;
		}
		else return true;	
	}

}
// END Rrd Class

/* End of file Rrd.php */