<?php

namespace App\Http\Controllers\Androidlaravel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Androidlaravel\Statement;
use App\Http\Controllers\Phpcodewriter\Phpcodewriter;

class Statement extends Controller
{
    //

//the method below gets the route code and function code
public static function getRouteAndFunctionAndJavaCode($array){
  $resultString = "";

  //$resultString.="something \n";
  $resultString.=Phpcodewriter::writeIntervals("The Route codes");
  $resultString.= Statement::getRouteCode($array)."\n";

$resultString.=Phpcodewriter::writeIntervals("Php function code to add new data");
  $resultString.=Statement::getFunctionCodeForAddnew($array);

$resultString.=Phpcodewriter::writeIntervals("The code for link execution");
  $resultString.=Statement::getAndroidCodeForLinkExecution($array);
      //
  return $resultString;
}


    //the method below gets the route's code
    public static function getRouteCode($array){

      $className = $array['className'];

    $fields = $array['fields'];
$addfunctionName = $array['functionName'];

$routeLink = 'Route::get(\'/'.$className.'/'.$addfunctionName;
$fieldsLink = "";
foreach($fields as $key=>$field){

  $fieldsLink.="/".$field."/{".$field."}\n";

}

$routeLink.=$fieldsLink;

$functionPath = ucwords($className)."@$addfunctionName');";

$routeLink.="','".$functionPath;
//echo $fieldsLink;
//echo $routeLink;
//echo $resultString;

return $routeLink;
    }

    //the method below gets the function code for add new
    public static function getFunctionCodeForAddnew($array){

        $resultString = "";

  $className = $array['className'];

$fields = $array['fields'];
//$addfunctionName = "api_add_new";
$addfunctionName = $array['functionName'];
$functionFields = "";


$i=0;

foreach($fields as $field){
    if($i==0){
        $functionFields.="$".$field;
    }else{
        $functionFields.=","."$".$field;
    }
    $i++;
}


$colNames = "";
$questionMarks = "";
$i=0;
foreach($fields as $field){
    if($i==0){
        $colNames.=$field;
        $questionMarks.="?";
    }else{
        $colNames.=",".$field;
        $questionMarks.=",?";
    }
    $i++;
}

$whereData = "";
//name = :name and phone_number = :phone_number',
//['name' => $name,'phone_number'=>$phone_number]
$i=0;

foreach($fields as $field){
    if($i==0){
        $whereData.=$field." =:".$field;
    }else{
        $whereData.=" and ".$field." =:".$field;
    }
    $i++;
}
$i=0;
//echo $whereData;
$fieldsData = "[";
$i=0;

foreach($fields as $field){
    if($i==0){
        $fieldsData.="'".$field."' => $".$field;
    }else{
        $fieldsData.=" , '".$field."' => $".$field;
    }
    $i++;
}

$fieldsData.="]";
$i=0;
$whereData .="',".$fieldsData;
//echo $whereData;
  $resultString.='protected function '.$addfunctionName.'('.$functionFields.'){
'."\n";
  $resultString.='
'."\n";
  $resultString.='        	//echo "Hey There !";
'."\n";
  $resultString.='
'."\n";

$i=0;

foreach($fields as $field){

  $resultString.='            '."$".$field.' = urldecode('."$".$field.');
'."\n";
    $i++;
}
  $resultString.='
'."\n";
  $resultString.='            //check of data allready exists
'."\n";
  $resultString.='            $results = DB::select(\'select * from registrations where '.$whereData.');
'."\n";
  $resultString.='
'."\n";
  $resultString.='            if(sizeof($results)){
'."\n";
  $resultString.='                //registration with same detail allready exists, skip addition
'."\n";
  $resultString.='            }else{
'."\n";
  $resultString.='
'."\n";
  $resultString.='                DB::insert(\'insert into registrations ('.$colNames.')
'."\n";
  $resultString.='                values ('.$questionMarks.')\', ['.$functionFields.']);
'."\n";
  $resultString.='            }
'."\n";
  $resultString.='
'."\n";
  $resultString.='        	echo \'Data added successfully !\';
'."\n";
  $resultString.='
'."\n";
  $resultString.='
'."\n";
  $resultString.='        }'."\n";



return $resultString;
    }


    //the method below returns the android code for link execution
    public static function getAndroidCodeForLinkExecution($array){

$functionName = $array['functionName'];


$resultString = "";

$className = $array['className'];

$fields = $array['fields'];
//$addfunctionName = "api_add_new";

$formDatas = "";
$appLink = "/".$className."/".$functionName;
$i=0;
foreach($fields as $key=>$value){


    if($i==0){
         $formDatas.="{\"".$value."\",".strtoupper($value)."}\n";
    }else{
         $formDatas.=",{\"".$value."\",".strtoupper($value)."}\n";
    }
    $i++;
}

//echo $formDatas;

  $resultString.='String [][]formData = {'.$formDatas.'};
'."\n";

  $resultString.='                new HttpOperations(ctx).executeApiLink(formData,BASE_URL+"'.$appLink.'",ctx);'."\n";


return $resultString;
    }


    public static function getRouteFunctionJavacodeforEditing($array){



    $resultString = "";

    $resultString.=Statement::getAndroidCodeForLinkExecution($array);
    $resultString.=Statement::getRouteCode($array);
$functionName = $array['functionName'];

$fields = $array['fields'];

$fieldString = "";

$i=0;
foreach($fields as $val){

    if(sizeof($fields)-1==$i){

$fieldString.="$".$val;    }else{

$fieldString.="$".$val.", ";    }
    $i++;

}

$i=0;


 $urlencodes = "";
 $i=0;
foreach($fields as $val){

    if(sizeof($fields)-1==$i){

$resultString.="$".$val." = urldecode(".$val.");";    }else{

$resultString.="$".$val." = urldecode(".$val.");"."
";    }
    $i++;

}

$setData = "";

$i=0;
foreach($fields as $val){

    if(sizeof($fields)-1==$i){

$setData.=$val." = '".$val.");";    }else{

$setData.=$val." = '".$val.");".", ";    }
    $i++;

}

$i=0;




$i=0;

  $resultString.='protected function '.$functionName.'('.$fieldString.'){
'."\n";
  $resultString.='
'."\n";
  $resultString.='        	//echo "Hey There !";
'."\n";
  $resultString.=$urlencodes.'
'."\n";

  $resultString.='
'."\n";
  $resultString.='            $phone_number = urldecode($phone_number);
'."\n";
  $resultString.='            $address = urldecode($address);
'."\n";
  $resultString.='
'."\n";
  $resultString.='            //check of data allready exists
'."\n";
  $resultString.='            DB::insert(\'update registrations set '.$setData.'" where donor_id = ?\', [$id]);
'."\n";
  $resultString.='
'."\n";
  $resultString.='            echo \'Registration updated successfully !\';
'."\n";
  $resultString.='
'."\n";
  $resultString.='
'."\n";
  $resultString.='        }'."\n";

    return $resultString;
}



public static function getAjaxHtmlFormCode($array){
  $resultString = "";

    $resultString.= Statement::getHtmlCodeForAjaxForm($array['vars']);
      $resultString.="\n".'//////////////////////////////////////////////////////////////'."\n";
      $resultString.='//THE HTML CODES ABOVE'."\n";
      $resultString.='//////////////////////////////////////////////////////////////'."\n";

    $resultString.= "\n".Statement::getAjaxMethod($array['vars']);


  return $resultString;
}



public static function getHtmlCodeForAjaxForm($array){

  $resultString= "";
  $i=0;
      foreach($array as $val){
          
          if(sizeof($array)-1==$i){
              
              $resultString.='<input type=\'text\' name=\''.$val.'\' id=\''.$val.'\' value=\'\' >';    }else{
                      
              $resultString.='<input type=\'text\' name=\''.$val.'\' id=\''.$val.'\' value=\'\' >'."
              ";    
            }
          $i++;
          
      }

  $i=0;

  return $resultString;

}

//get ajax method
public static function getAjaxMethod($array){

$resultString = "";


//globalize the vars
$i=0;
foreach($array as $val){
    
    if(sizeof($array)-1==$i){
        
$resultString.='var '.$val.' = "";';    }else{
        
$resultString.='var '.$val.' = "";'."
";    }
    $i++;
    
}

$i=0;


//define the init variables

  $resultString.='function initData(){'."\n";
  $resultString.='    '."\n";
              $i=0;
              foreach($array as $val){
                  
                  if(sizeof($array)-1==$i){
                      
                      $resultString.=' '.$val.' = $(\''."#".$val.'\').val();';    }else{
                              
                      $resultString.=' '.$val.' = $(\''."#".$val.'\').val();'."
                      ";    
                  }
                  $i++;
                  
              }

              $i=0;

  $resultString.='}'."\n";



//check if variables are correct

  $resultString.='function dataCorrect(){'."\n";
  $resultString.='    dataCorrect = true;'."\n";
                $i=0;
              foreach($array as $val){
                  
                  if(sizeof($array)-1==$i){
                      
              $resultString.='if(('.$val.'=="")||('.$val.'==null)){ dataCorrect = false;}';    }else{
                      
              $resultString.='if(('.$val.'=="")||('.$val.'==null)){ dataCorrect = false;}'."
              ";    }
                  $i++;
                  
              }

              $i=0;

  $resultString.='    '."\n";
  $resultString.='    return dataCorrect;'."\n";
  $resultString.='}'."\n";




//prepare the ajax data to be posted
  $ajaxDataTBP = "";

      $i=0;
      foreach($array as $val){
          
          if(sizeof($array)-1==$i){
              
              $ajaxDataTBP.=' '.$val.' : '.$val.'';    }else{
                      
              $ajaxDataTBP.=' '.$val.' : '.$val.''.", ";    }
                  $i++;
          
      }

      $i=0;

//get the ajax method

  $resultString.='function performAjax(){'."\n";
  $resultString.='    '."\n";
          $resultString.='$.ajaxSetup({'."\n";
          $resultString.='      global: false,'."\n";
          $resultString.='      type: "POST",'."\n";
          $resultString.='      url: "http://127.0.0.1:8000/editor/process_code/",'."\n";
          $resultString.='      beforeSend: function () {'."\n";
          $resultString.='         //$(".modal").show();'."\n";
          $resultString.='         //console.log("Sending started...");'."\n";
          $resultString.='      },'."\n";
          $resultString.='      complete: function () {'."\n";
          $resultString.='          //$(".modal").hide();'."\n";
          $resultString.='         //console.log("Sent complete !");'."\n";
          $resultString.='      }'."\n";
          $resultString.=''."\n";
          $resultString.='  });// csrfmiddlewaretoken: \'{{ csrf_token }}\''."\n";
          $resultString.='  $.ajax({'."\n";
          $resultString.='      data:{'.$ajaxDataTBP."}\n,";
          $resultString.='        statusCode: {'."\n";
          $resultString.='            500: function() {'."\n";
          $resultString.='                //alert(" 500 data still loading");'."\n";
          $resultString.='                console.log(\'500 \');'."\n";
          $resultString.='                $(\'#console_div\').html(\'<b style="color:red;">Getting 500 error</b>\');'."\n";
          $resultString.='            }'."\n";
          $resultString.='        },'."\n";
          $resultString.='      success: function (data) {'."\n";
          $resultString.='        //console.log("Results from the ajax : "+data);'."\n";
          $resultString.='        editor_output.setValue(data);'."\n";
          $resultString.='        //editor_output.setValue(data);'."\n";
          $resultString.='        $(\'#console_div\').html(\'<b style="color:green;">Going fine</b>\');'."\n";
          $resultString.=''."\n";
          $resultString.='      }'."\n";
          $resultString.=''."\n";
          $resultString.='  });'."\n";
  $resultString.='    '."\n";
  $resultString.='}'."\n";


  

  $resultString.='function checkDataAndPost(){'."\n";
  $resultString.='    '."\n";
  $resultString.='    initData();'."\n";
  $resultString.='    '."\n";
  $resultString.='    if(dataCorrect()){'."\n";
  $resultString.='        performAjax();'."\n";
  $resultString.='    }'."\n";
  $resultString.='}'."\n";


  return $resultString;
}

}