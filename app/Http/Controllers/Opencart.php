<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Opencart\Statement\Statement;

class Opencart extends Controller
{
    //

    //controller methods
public function opencart_main(){

    return view('opencart.editor');
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
          $val = json_decode($jsonString,true);
          $code = "";
          switch ($selected_functionality) {


            case 'createSimpleGetPagePage':
            $code = Statement::createSimpleGetPagePage($val);
            break;

            default:
            $code = "Please select functionality...";
            break;
          }

          //json_decode('{"foo":"bar"}');
          //echo "going great !";
          echo $code;
        }

}
