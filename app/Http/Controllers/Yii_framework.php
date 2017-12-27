<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Yii_framework extends Controller
{
    

    //controller methods
public function yii_framework_main(){

    return view('yii_framework.editor');
      }


//for testing functions
public function test_function(){

    //return view('common.test');
    //init the code and test the function
    $code = "";
    echo $code;

      }


//take the json as input, and output the language code
        public function getLanguageCode(Request $request){

          $jsonString = $request->input('json');
          $selected_functionality = $request->input('selected_functionality');
          //echo "The selected functionality : ".$request->input('selected_functionality');
          //$val = json_decode($jsonString,true);
          $code = "";
          // switch ($selected_functionality) {
          //   case 'getCode':
          //   $code = Somelanguage::getCode($val );
          //   break;

          //   default:
          //   $code = "Please select functionality...";
          //   break;
          // }

          //json_decode('{"foo":"bar"}');
          //echo "going great !";
          echo $jsonString;
        }


}
