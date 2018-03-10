<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Database_design\Design_code;
use App\Models\json_table;

use Illuminate\Http\Request;

class Database_design extends Controller
{
    //

    //controller methods
public function Database_design_main(){

	//get the databases
	$databases = json_table::all();

    return view('Database_design.editor',["databases"=>$databases]);
      }


//for testing functions
public function test_function(){

    //return view('common.test');
    //init the code and test the function
    $code = "";
    echo $code;

      }


	public function getLanguageCode(Request $request){


          $jsonString = $request->input('json');
          $selected_functionality = $request->input('selected_functionality');

          $coloumnNames = json_decode($jsonString,true);
          $code = $request->input('code');

          //echo "The code - ".$code;
          //echo "The selected functionality : ".$request->input('selected_functionality');

          //$code = "";
          // switch ($selected_functionality) {
            
          //   case 'getCode':
          //   $code = $jsonString;//$this->getCode($val );
          //   break;

          //   case 'designCodeBasedOnDatabase':
          //   $code = Design_code::designCodeBasedOnDatabase($val);
          //   break;

          // }
          $code = $this->designCodeBasedOnDatabase($coloumnNames, $code);

          //json_decode('{"foo":"bar"}');
          //echo "going great !";
          echo $code;
	}   


	//get the code
	public function getCode(){

	    $code= "";

	    return $code;

	}   

	public function designCodeBasedOnDatabase($coloumnNames, $code){

			$resultString = "";
			foreach ($coloumnNames as $key => $value) {
				$currentChangedCode = str_replace('#', $value, $code);
				$resultString.=$currentChangedCode."\n";
			}

			return $resultString;

	}

}
