<?php 

class Jsondb
{

    private $json_db_path = 'db';

    public function get_data($struct_name,$index = null,$return_associate_array = true){

        $file_content = file_get_contents($this->json_db_path.'/' . $struct_name .'.json');

        if($return_associate_array){
            $file_content = json_decode($file_content, true);
        }else{
            $file_content = json_decode($file_content);
        }

        if (!is_null($index))
        {
            $file_content = $file_content[$struct_name][intval($index)];
        }
        
        return $file_content;

    }

    public function add_data($struct_name,$data_array){

        $file_content = $this->get_data($struct_name);

        $file_content[$struct_name] = array_values($file_content[$struct_name]);

        array_push($file_content[$struct_name], $data_array);
        $result = file_put_contents($this->json_db_path.'/' . $struct_name .'.json', json_encode($file_content));

        if($result){
            return true;
        }
        else{
            return false;
        }
  
    }

    public function update_data($struct_name,$data_array,$id){

        $file_content_all = $this->get_data($struct_name);
        
		$file_content_id = $file_content_all[$struct_name];
		$file_content_id = $file_content_id[$id];

		if ($file_content_id) {

            unset($file_content_all[$struct_name][$id]);
            
			$file_content_all[$struct_name][$id] = $data_array;
            $file_content_all[$struct_name] = array_values($file_content_all[$struct_name]);
            
			$result = file_put_contents($this->json_db_path.'/' . $struct_name .'.json', json_encode($file_content_all));
        }
        
        if($result){
            return true;
        }
        else{
            return false;
        }

    }

    public function delete_data($struct_name,$id){

        $file_content_all = $this->get_data($struct_name);

        $file_content_id = $file_content_all[$struct_name];
        $file_content_id = $file_content_id[$id];
    
        if ($file_content_id) {
            unset($file_content_all[$struct_name][$id]);
            $file_content_all[$struct_name] = array_values($file_content_all[$struct_name]);
            $result = file_put_contents($this->json_db_path.'/' . $struct_name .'.json', json_encode($file_content_all));
        }

        if($result){
            return true;
        }
        else{
            return false;
        }
        
    }

}
