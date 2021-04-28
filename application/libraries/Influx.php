<?php 

class Influx
{

    function get_data($db,$query,$username,$password){

        if (!$this->_iscurl()){            
            return "Error: -1001 cURL Not Enabled"; // will do another action
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://localhost:8086/query?db=". $db ."&amp;u=". $username ."&amp;p=". $password ."&amp;q=". urlencode($query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);

        $headers = array();
        $headers = array('Content-Type: application/json','Accept: application/json');

        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Error: -1002 ' . curl_error($ch);
        }

        curl_close($ch);

        $arr_result = array();
        $arr_result = json_decode($result, true);

        return $arr_result;

    }

    function get_interface_traffic_data($host,$interface,$db,$username,$password) {

        $query='';
        $measurements = array('interface_tx','interface_rx');

        foreach ($measurements as $value){
            $query .= "SELECT non_negative_derivative(mean(value), 1s)  *8 as val FROM ". $value ." WHERE (host = '". $host ."' AND type = 'if_octets' AND instance = '". $interface ."') AND time > now() - 5m group by time(10s) fill(null);";
        }

        foreach ($measurements as $value){
            $query .= "SELECT min(val) as min,max(val) as max,mean(val) as avg,last(val) as current,sum(val) as total from  (SELECT non_negative_derivative(mean(value), 1s)  *8 as val FROM ". $value ." WHERE (host = '". $host ."' AND type = 'if_octets' AND instance = '". $interface ."') AND time > now() - 5m group by time(10s) fill(null));";
        }

        return $this->get_data($db,$query,$username,$password);

        //echo $query;

        //"select (100-mean(usage_idle)) from cpu where type = 'cpu-total' and time > now() - 5m group by time(10s) fill(null))"

        //$query_rx = "SELECT non_negative_derivative(mean(value), 1s)  *8 FROM interface_rx WHERE (host = '". $host ."' AND type = 'if_octets' AND instance = '". $interface ."') AND time > now() - 5m group by time(10s) fill(null)";
        //$query_tx = "SELECT non_negative_derivative(mean(value), 1s)  *8 FROM interface_tx WHERE (host = '". $host ."' AND type = 'if_octets' AND instance = '". $interface ."') AND time > now() - 5m group by time(10s) fill(null)";

        // "SELECT min(non_negative_derivative),max(non_negative_derivative),mean(non_negative_derivative),sum(non_negative_derivative),last(non_negative_derivative) from  (SELECT non_negative_derivative(mean(value), 1s)  *8 FROM interface_rx WHERE (host = 'SdnRouter' AND type = 'if_octets' AND instance = 'enp1s0') AND time > now() - 5m group by time(10s) fill(null));
        // SELECT min(non_negative_derivative),max(non_negative_derivative),mean(non_negative_derivative),sum(non_negative_derivative),last(non_negative_derivative) from  (SELECT non_negative_derivative(mean(value), 1s)  *8 FROM interface_tx WHERE (host = 'SdnRouter' AND type = 'if_octets' AND instance = 'enp1s0') AND time > now() - 5m group by time(10s) fill(null))";

    }

    function _isCurl() {
        return function_exists('curl_version');
    }
   
    


}

?>