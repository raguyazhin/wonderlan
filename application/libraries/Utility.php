<?php 

class Utility
{

    function chop_last_char($string) {
        return  substr(trim($string), 0, -1);
    }

    function dir_copy($src, $dst) {  
   
        // open the source directory 
        $dir = opendir($src);  
       
        // Make the destination directory if not exist 
        @mkdir($dst);  
       
        // Loop through the files in source directory 
        foreach (scandir($src) as $file) {  
       
            if (( $file != '.' ) && ( $file != '..' )) {  
                if ( is_dir($src . '/' . $file) )  
                {  
       
                    // Recursively calling custom copy function 
                    // for sub directory  
                    dir_copy($src . '/' . $file, $dst . '/' . $file);  
       
                }  
                else {  
                    copy($src . '/' . $file, $dst . '/' . $file);  
                }  
            }  
        }  
       
        closedir($dir); 
    }   

    function get_time_ago( $time )
    {
        $time_difference = time() - $time;

        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;

            if( $d >= 1 )
            {
                $t = round( $d );
                return $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
   
}