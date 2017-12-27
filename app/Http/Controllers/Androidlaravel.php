<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Androidlaravel\Statement;

class Androidlaravel extends Controller
{
    //

    //controller methods
public function androidlaravel_main(){

    return view('androidlaravel.editor');
      }


//for testing functions
public function test_function(){

    //return view('common.test');
    //init the code and test the function

$val = json_decode('{"vars":{"0":"fieldOne","2":"fieldTwo"}}',true);
    $code = Statement::getAjaxHtmlFormCode($val);
    //$code = "";
    echo $code;

      }


//take the json as input, and output the language code
        public function getLanguageCode(Request $request){

          $jsonString = $request->input('json');
          $selected_functionality = $request->input('selected_functionality');
          //echo "The selected functionality : ".$request->input('selected_functionality');
          $val = json_decode($jsonString,true);
          $code = "";
          switch ($selected_functionality) {
            case 'getRouteAndFunctionAndJavaCode':
            $code = Statement::getRouteAndFunctionAndJavaCode($val );
            break;

            case 'getRouteFunctionJavacodeforEditing':
              $code = Statement::getRouteFunctionJavacodeforEditing($val);
              break;

            case 'getAjaxHtmlFormCode':
              $code = Statement::getAjaxHtmlFormCode($val);
              //$code = $val;
              break;  

            default:
            $code = "Please select functionality...";
            break;
          }

          //json_decode('{"foo":"bar"}');
          //echo "going great !";
          echo $code;
        }



//get the code
public function getCode(){

    $code= "";

    return $code;

}
}
