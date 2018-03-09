<?php

namespace App\Http\Controllers\Laravel\Database;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Database extends Controller
{
    //

    //php code for the function
public static function createTableJson($data){
    
    $rawData = explode("\n",$data);

    // var_dump($rawData);
    // echo "<br>";

    
    $resultArray = array();
    $currentTableName = "";
    foreach ($rawData as $key => $value) {
    	
    	
    	
    	//if the siring exists, add to coloumn
    	if(preg_match('/\s/',$value)>0){
    		
    		//is a coloumn name
    		$currentColoumnName = $value;
    		//var_dump(strlen("	"));
    		if(strlen(ltrim($currentColoumnName))<1){
				
    		}else{
    			$resultArray[$currentTableName][] = ltrim($currentColoumnName);
    		}
    		
    	}else{
    		
    		

    		// echo $value;
    		// echo "<br>";
    		//is a table name
    		$currentTableName  = $value;
    		$resultArray[$currentTableName] = array();
    		
    		

    		
    	}

    }

    return json_encode($resultArray);
}
}
