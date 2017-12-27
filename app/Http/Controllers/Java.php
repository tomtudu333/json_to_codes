<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Java\Statement\Statement;
use App\Http\Controllers\Library\Number\Numberopertation;
use App\Http\Controllers\Library\String\Stringoperation;
use App\Http\Controllers\Laravel\Statement\Statement as Laravelstatement;

class Java extends Controller
{
    //

    //testing
    public function test(){

    //return view('common.test');

    // $java_code = $this->getSaveDataStatements(json_decode('{"editText":"something"}',true));
    // var_dump($java_code);
    // $result = Statement::createTableInfoCodes(json_decode('{"tableName":"something","databaseName":"something","cols": {"0":"some","1":"cols"}}',true));
    $result = Statement::getFormView(json_decode('{"fields":{"0":{"fieldName":"someName","fieldType":"editText"}}}',true));

     echo   $result;
      }

      //main
      public function java_main(){

      return view('java.java');
        }

        //take the json as input, and output the java code
        public function getJavaCode(Request $request){

          $jsonString = $request->input('json');
          $selected_functionality = $request->input('selected_functionality');
          //echo "The selected functionality : ".$request->input('selected_functionality');
          $val = json_decode($jsonString,true);
          $code = "";
          switch ($selected_functionality) {
            case 'dataCorrect':
            $code = $this->getInitAndDataCorrectStatements($val );
            break;

            case 'saveData':
            $code = $this->getSaveDataStatements($val);
            break;

            case 'createTableInfoCodes':
            $code = Statement::createTableInfoCodes($val);
            break;

            case 'getFormView':
            $code = Statement::getFormView($val);
            break;

            default:
            $code = "Please select functionality...";
            break;
          }

          //json_decode('{"foo":"bar"}');
          //echo "going great !";
          echo $code;
        }
























//////////////////////////////////////////////////////////////////////
//below are the deeper codes for json to java codes conversion


//the method below converts json to init and check android statements
public function getInitAndDataCorrectStatements($ObjArray){

$resultString = "boolean dataCorrect = true;";
$resultString .= "\n";
$resultString .= "\n";

//for initializing
$resultString .= "//Initializing\n";
  foreach ($ObjArray as $key => $value) {
    # code...
    if($key=="editText"){
      $resultString .= "  String ".$value." =((EditText)findViewById(R.id.editText1)).getText().toString();\n";
    }

    if($key=="spinner"){
      $resultString.="  String ".$value." = ((Spinner)findViewById(R.id.spinner2)).getSelectedItem().toString();\n";
    }

    if($key=="datePicker"){
      $resultString.="  String ".$value." = ((Button)findViewById(R.id.button2)).getText().toString();\n";
    }

    if($key=="timePicker"){
      $resultString.="  String ".$value." = ((Button)findViewById(R.id.button2)).getText().toString();\n";
    }
  }
$resultString .= "\n";
$resultString .= "\n";

$resultString .= "//checking for errors\n";
  //for checking if data is correct
  foreach ($ObjArray as $key => $value) {
    # code...
    $resultString .= "  if(".$value.".equals(\"\")||".$value."==null){ dataCorrect = false; }\n";

  }

$resultString .= "\n";
$resultString .= "\n";
  //now return the data correct value
  $resultString.="return dataCorrect;";

  return $resultString;
}


//create the functionality to save data
public function getSaveDataStatements($ObjArray){

$resultString = "";
  $resultString .= "\n";
  $resultString .= "\n";

  //for initializing
  $resultString .= "//Initializing\n";
    foreach ($ObjArray as $key => $value) {
      # code...
      if($key=="editText"){
        $resultString .= "  String ".$value." =((EditText)findViewById(R.id.editText1)).getText().toString();\n";
      }

      if($key=="spinner"){
        $resultString.="  String ".$value." = ((Spinner)findViewById(R.id.spinner2)).getSelectedItem().toString();\n";
      }
    }

    $resultString.="\n";
    $resultString.="\n";

    $resultString.="final DatabaseOperations db = new DatabaseOperations(this);

        //populate with table coloumn names
        final String []directoryCols = RegistrationTableData.TableInfo.colsToReturnWithoutId;

        final Intent intent = new Intent(this,MainActivity.class);
        AsynchronousTask aTask = new AsynchronousTask(ctx){

          public void performFunction(){";

          $resultString.="\n";
          $resultString.="\n";

$resultString.="String []data = {";
      $i=0;
      foreach ($ObjArray as $key => $value) {
            # code...
            //$resultString.=$value;
            if($i==0){
              $resultString.=$value;
            }else{
              $resultString.=",".$value;
            }
            $i++;
      }

  $resultString.="};";


    $resultString.="
                db.addRow(RegistrationTableData.TableInfo.tableName,directoryCols,data);
                startActivity(intent);
                //System.out.println('THE OUTPUT RESULT : '+result);
            }
        };
        aTask.BEGINNING_MSG='registering...';
        aTask.END_MSG= 'please wait... !';
        aTask.execute();
";

return $resultString;
}

//the method below converts the string into php resultString OUTPUT
public function convertPhpStringToResultString(Request $request){

  //$string = str_replace("\"","\\"."\"", $request->input('string'));

  $string = str_replace("'","\'", $request->input('string'));
    //$string = str_replace("\\","\\\\",$string);

  $lines = explode("\n",$string);

$outPutString = "";
  foreach ($lines as $line) {
    # code...
    $outPutString.='  $resultString.=\''.$line.'\'."\n";'."\n";
  }

  echo $outPutString;
}

//the method below creates the resultstring with variable names
public  function convertPhpStringToResultStringWithVar(Request $request){


    $codeString = $request->input('string');

      $string = str_replace("'","\'", $codeString);
        //$string = str_replace("\\","\\\\",$string);

      $lines = explode("\n",$string);

    $outPutString = "";
      foreach ($lines as $line) {

        $line = str_replace('$var$','\'.$var.\'',$line );
        # code...
        $outPutString.='  $resultString.=\''.$line.'\'."\n";'."\n";
      }


    echo $outPutString;
}

//the method below creates the resultstring with variableName and for loop
public  static function convertPhpStringToResultStringWithVarFOLO(Request $request){


      $codeString = $request->input('string');

        $string = str_replace("'","\'", $codeString);
          //$string = str_replace("\\","\\\\",$string);

        $lines = explode("\n",$string);

      $outPutString = "";
      $countForLoops = 0;
        foreach ($lines as $line) {

          $line = str_replace('$var$','\'.$var.\'',$line );



          //check for the for loop initiation symbol
          $loopInitiationSymbolDetails = Stringoperation::findCOdeBlocksInString("<",">",$line);


          if(sizeof($loopInitiationSymbolDetails)>0){

            //var_dump($loopInitiationSymbolDetails);
            //remove the loop codes from line
            foreach($loopInitiationSymbolDetails as $val){
              $line = str_replace($val[2],"",$line);
            }
            //echo $line;
            $brokenLine = explode("<>",$line);
            $finalLine = ""; $allLoopCodes = "";
            $loopCodeCount = 0;

            foreach($loopInitiationSymbolDetails as $val){

              $currentStringsNVars = $val[2];
              $line = str_replace($currentStringsNVars,"",$line);
              $currentCodestartPos = $currentStringsNVars[0];

              $currentInitStringVarName = '$loop_'.str_replace(" ","",Numberopertation::convert_number_to_words($countForLoops));

              $currentLoopCode = Laravelstatement::createForLoopTwo($currentStringsNVars,$currentInitStringVarName);


              $allLoopCodes.=$currentLoopCode;
              //echo "Current loop code - ".$allLoopCodes;
              $finalLine.=$brokenLine[$loopCodeCount]."'.".$currentInitStringVarName.".'";
              //var_dump($brokenLine[$countForLoops]);
              $countForLoops++;$loopCodeCount++;
              //echo "Loo[ing - ".$countForLoops;
            }
            //echo $allLoopCodes;

            if($allLoopCodes==""){}else{
              $finalLine.=$brokenLine[$loopCodeCount];
              $line = $finalLine;
              //echo $line;
              //echo $allLoopCodes;
              $outPutString.=$allLoopCodes;
              $outPutString.='  $resultString.=\''.$line.'\'."\n";'."\n";

              //echo $outPutString;
            }
            // if(isset($brokenLine[$countForLoops])){
            //
            // }



          }else{

            $outPutString.='  $resultString.=\''.$line.'\'."\n";'."\n";
          }


          # code...


        }


      echo $outPutString;
}

//the method below converts the javascript code to result string
public function convertJScriptToResultStringWithVar(Request $request){

  $codeString = $request->input('string');

    $string = str_replace("'","\'", $codeString);
      $string = str_replace("\\","\\\\",$string);

    $lines = explode("\n",$string);

  $outPutString = "";
    foreach ($lines as $line) {

      $line = str_replace('$var$','\'.var.\'',$line );
      # code...
      $outPutString.='  resultString+=\''.$line.'\'+"\n";'."\n";
    }


  echo $outPutString;
}




}
