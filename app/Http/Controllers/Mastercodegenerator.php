<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mastercodegenerator extends Controller
{
    //

    public function test_function(){

    //return view('common.test');
    $array = ["language"=>"laravel"];
    $code = $this->getRouteFunctionandAjax($array);
    echo $code;

      }

    //main
    public function mastercodegenerator_main(){

    return view('mastercodegenerator.editor');
      }

    //generate the code
    public function getCode(Request $request){

      $jsonString = $request->input('json');
      $selected_functionality = $request->input('selected_functionality');
      //echo "The selected functionality : ".$request->input('selected_functionality');
      $val = json_decode($jsonString,true);
      $java_code = "";
      switch ($selected_functionality) {
        case 'getRouteFunctionandAjax':
        $java_code = $this->getRouteFunctionandAjax($val );
        break;

        default:
        $java_code = "Please select functionality...";
        break;
      }

      //json_decode('{"foo":"bar"}');
      //echo "going great !";
      echo $java_code;
    }













//////////////////////////////////////////////////////////////////////////
//code generator funtions
    public function getRouteFunctionandAjax($ObjArray){


      $resultString = "";
      $language = $ObjArray['language'];

      $controllerNameinCap = ucwords($language);
      //prepare the routes
      $resultString.="//route\n";
      $resultString.="\n";

      $resultString.="//the editor panel\n";
      $resultString.="Route::get('/".$language."','".$controllerNameinCap."@".$language."_main');";

$resultString.="\n";
$resultString.="//post method to get the codes\n";
      $resultString.="Route::post('/".$language."/get_codes','".$controllerNameinCap."@getLanguageCode');";
$resultString.="\n";

$resultString.="//to test the functions in this package\n";
      $resultString.="Route::get('/".$language."/test_functions','".$controllerNameinCap."@test_function');";

        $resultString.="\n";
          $resultString.="\n";

        $resultString.="//controller methods\n";


        $resultString.='public function '.$language.'_main(){'."\n";
$resultString.=''."\n";
$resultString.='    return view(\''.$language.'.editor\');'."\n";
$resultString.='      }'."\n";


        $resultString.="\n";
          $resultString.="\n";

      $resultString.="//for testing functions\n";

      $resultString.='public function test_function(){'."\n";
      $resultString.=''."\n";
      $resultString.='    //return view(\'common.test\');'."\n";
      $resultString.='    //init the code and test the function'."\n";
      $resultString.='    $code = "";'."\n";
      $resultString.='    echo $code;'."\n";
      $resultString.=''."\n";
      $resultString.='      }'."\n";


      $resultString.="\n";
        $resultString.="\n";

        $resultString.='//take the json as input, and output the language code'."\n";
        $resultString.='        public function getLanguageCode(Request $request){'."\n";
        $resultString.=''."\n";
        $resultString.='          $jsonString = $request->input(\'json\');'."\n";
        $resultString.='          $selected_functionality = $request->input(\'selected_functionality\');'."\n";
        $resultString.='          //echo "The selected functionality : ".$request->input(\'selected_functionality\');'."\n";
        $resultString.='          $val = json_decode($jsonString,true);'."\n";
        $resultString.='          $code = "";'."\n";
        $resultString.='          switch ($selected_functionality) {'."\n";
        $resultString.='            case \'getCode\':'."\n";
        $resultString.='            $code = Somelanguage::getCode($val );'."\n";
        $resultString.='            break;'."\n";
        $resultString.=''."\n";
        $resultString.='            default:'."\n";
        $resultString.='            $code = "Please select functionality...";'."\n";
        $resultString.='            break;'."\n";
        $resultString.='          }'."\n";
        $resultString.=''."\n";
        $resultString.='          //json_decode(\'{"foo":"bar"}\');'."\n";
        $resultString.='          //echo "going great !";'."\n";
        $resultString.='          echo $code;'."\n";
        $resultString.='        }'."\n";

        $resultString.="\n";
          $resultString.="\n";
          $resultString.="\n";



      $resultString.="///////////////////////////////////////\n";
        $resultString.="///ajax code\n";

  $resultString.='function postJsonAndGetJavaCodes(){
'."\n";
  $resultString.='
'."\n";
  $resultString.='          var json_value = editor.getValue();
'."\n";
  $resultString.='          var selected_functionality = $(\'#functionality\').val();
'."\n";
  $resultString.='          console.log("The selected functionalitu : "+selected_functionality);
'."\n";
  $resultString.='$.ajaxSetup({
'."\n";
  $resultString.='    global: false,
'."\n";
  $resultString.='    type: "POST",
'."\n";
  $resultString.='    url: "{{ url(\'/\') }}/'.$language.'/get_codes",
'."\n";
  $resultString.='    beforeSend: function () {
'."\n";
  $resultString.='       //$(".modal").show();
'."\n";
  $resultString.='       //console.log("Sending started...");
'."\n";
  $resultString.='    },
'."\n";
  $resultString.='    complete: function () {
'."\n";
  $resultString.='        //$(".modal").hide();
'."\n";
  $resultString.='      //  console.log("Sent complete !");
'."\n";
  $resultString.='    }
'."\n";
  $resultString.='});// _token: \'{{ csrf_token() }}\'
'."\n";
  $resultString.='$.ajax({
'."\n";
  $resultString.='    data:{_token: \'{{ csrf_token() }}\'
'."\n";
  $resultString.='    , json : json_value,
'."\n";
  $resultString.='      selected_functionality: selected_functionality},
'."\n";
  $resultString.='    success: function (data) {
'."\n";
  $resultString.='      //console.log("Results from the ajax request are as follows : ");
'."\n";
  $resultString.='        //            console.log(data);
'."\n";
  $resultString.='      editor_output.setValue(data);
'."\n";
  $resultString.='    }
'."\n";
  $resultString.='});
'."\n";
  $resultString.='
'."\n";
  $resultString.='
'."\n";
  $resultString.='        }'."\n";



return $resultString;

    }
}
