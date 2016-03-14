<?php

 Class FileRead {
    
    /***********************************************************************
      1.  Get the file name
      2.  Locate the temporary directory
    ***********************************************************************/
    public function UPLOAD_FILE(){
        if (empty($_FILES['config']['name'])) {
           echo "UPLOAD A CONFIGURATION FILE";
        }elseif( isset( $_FILES['config'] )  ){
      		$errors= array();
      		$file_name = $_FILES['config']['name'];      		
      		$file_tmp =$_FILES['config']['tmp_name'];
            if(is_uploaded_file($file_tmp)){
            	echo "UPLOAD A NEW CONFIGURATION FILE";
            }
      		$file_ext=strtolower(end(explode('.',$_FILES['config']['name'])));
      		$VALID_EXTENSION = $this->Check_Extenxion($file_ext,$extensions);
            if($VALID_EXTENSION){
                  $data = $this->Readfile($file_tmp );
                  $this->display_results($data,$file_name);
            }
   	    }
    }
    # DISPLAY RESULTS
    private function display_results($data, $file_name){
    	echo "<h3>".$file_name. "</h3> Current Configuration.<br>";
        echo "<table border=\"1\">
      		     <tr>
                     <th>Configuration</th>
                     <th>Value</th>		
                   </tr>";
        echo $data;
        echo "</table><br>";
    }

    

    # Check if the file is a valid configuration file
    # No png,jpg,jpeg
    # Only accept .config .txt or .ini
    private function Check_Extenxion($file_ext){
    	$extensions= array("config","txt","ini","cfg");
        if(in_array($file_ext,$extensons)=== false){
         	$errors[]="extension not allowed, please choose a config file with extensions config,txt, or ini.";
         	return false;
      	}else{
      		return true;
      	}
    }
    # Read the file uploaded in the temporary directory
    # Read the file line per line
    # Return all the table rows
    private function Readfile($path){          
        $handle = fopen($path, "r");
        while ($line = fgets($handle)) {  
            $parsed = $parsed . $this->line_parse($line);
        }
        fclose($handle);
        return $parsed;
    }
    # Parse the line
    # Get rid of comments (comments starts with '#)
    # Ger rid of empty spaces
    private function line_parse($line){
    	if($line[0]!="#" AND $line[0]!=" " AND strlen($line) != 1 )
    	{
    	    $parsed_line = $this->config_report($line);
    	}
    	return $parsed_line;
    }
    # Split the string with the "=" delimiter
    # Return the table Rows
    private function config_report($line){
    	$line = explode("=", $line);
    	$CONFIG_NAME = $line[0]; 
    	$CONFIG_SWITCH = $this->boolean_value($line[1]);
    	$TABLE_ROW = "<tr><td>".$CONFIG_NAME."</td><td>".$CONFIG_SWITCH ."</td></tr>";    	  
    	return $TABLE_ROW;
    }
    # Adjust the values who are switches
    private function boolean_value($val){
    	$str = preg_replace('/\s+/', '', strtolower($val));
    	switch ($str){
    	   	case "true":
    	   	    return "true";
    	   	    break;
    	    case "on":    	   	     
    	   	    return "true";
    	   	    break;
       	    case "yes":
    	   	    return "true";
    	   	    break;
    	   	case "false":
    	   	    return "false";
    	   	    break;
    	   	case "off":    	   	     
    	   	    return "false";
    	   	    break;
    	   	case "no":
    	   	    return "false";
    	   	    break;       	   	     
    	   	default:
    	   	    return $val; 
    	}
    }
 }


?>