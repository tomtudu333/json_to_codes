<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;
use App\Http\Controllers\Laravel\Codegenerator;
use App\Http\Controllers\Laravel\Classes\Classes;

use App\Http\Controllers\Laravel\Statement\Statement;
use  App\Http\Controllers\Laravel\Page\Pagegenerator;
use App\Http\Controllers\Phpcodewriter\Phpcodewriter;

use App\Http\Controllers\Laravel\Database\Database;

class Laravel extends Controller
{
    //

    //for testing functions
public function test_function(){

    //return view('common.test');
    //init the code and test the function
    //$code = Codegenerator::test();
    //$array =['table_name'=>'my_table','cols'=>['some','cols'],"main_route"=>"some_route"];
    //"table_name":"my_table", "cols":["some","cols","names"], "main_route":"some_route"
    // $json = '{"functionPath":"your/class/then/function"}';

    // $val = json_decode($json,true);

    // var_dump($val);

    // $code = Pagegenerator::createSimpleGetPagePage($val);

    // echo "The code - ".$code;
    $data = 'table_one
  col_one
  col_two
  col_three




table_two
  table_col_one
  table_col_two 
  table_col_three';
    $joson = Database::createTableJson($data);

    echo $joson;
    //execute the function

    //$code = Statement::increaseFunctionality($array);

    // $array =['functionPath'=>'some\\thing\\functionName'];
    // $code = Pagegenerator::createSimpleGetPagePage(  $array);
    // echo $code;

    //Storage::disk('local')->put('../file.txt', 'Contents');
      // $file = '../app/Http/Controllers/Phpcodetest/Phpcodetest.php';
      // Phpcodewriter::writePhpCodestoFile("//some codes newly created...",$file);
      } 
 
      public function laravel_main(){

    return view('laravel.editor');
      }


      public function test_php(){

      return view('laravel.test_php');
      }

      //function to test the php code
      public function testPhpCode(Request $request){

        $file = '../app/Http/Controllers/Phpcodetest/Phpcodetest.php';
        $phpCode =  $request->input('php_code');
        Phpcodewriter::writePhpCodestoFile($phpCode,$file);
        echo $phpCode;

      }



//take the json as input, and output the language code
        public function getLanguageCode(Request $request){

          $jsonString = $request->input('json');
          $selected_functionality = $request->input('selected_functionality');
          //echo "The selected functionality : ".$request->input('selected_functionality');
          $val = json_decode($jsonString,true);
          $code = "";
          switch ($selected_functionality) {
            
            case 'getCode':
            $code = $this->getCode($val );
            break;

            case 'getPubFuncRScode':
            $code = Classes::getPubFuncRScode();
            break;

            case 'increaseFunctionality':
            $code = Statement::increaseFunctionality($val);
            break;

            case 'createSimpleGetPagePage':
            $code = Pagegenerator::createSimpleGetPagePage($val);
            break;

            case 'createForLoopPhp':
            $code = Statement::createForLoopPhp($val);
            break;

            case 'addEditDeleteCode':
            $code = Classes::addEditDeleteCode($val);
            break;

            case 'createAjaxCodes':
            $code = Pagegenerator::createAjaxCodes($val);
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














public function site_map(){

      return view('laravel.site_map');
}

}
