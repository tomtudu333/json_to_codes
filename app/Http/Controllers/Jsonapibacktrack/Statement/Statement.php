<?php

namespace App\Http\Controllers\Jsonapibacktrack\Statement;

use App\Http\Controllers\Jsonapibacktrack\Statement\Statement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Statement extends Controller
{
    //

    //the method below converts the json string to php code that outputs that kind of
    //json code
        public static function getJsonEquivalentPhpCodeOutput($val){

    $array = $val;

    $space = "";
    $resultString=  "";
    $masterArrayKey = "master_array";
    foreach($array as $key=>$val){
          if($key>=1){break;}

          if(is_array($val)){

               $resultString .=  Statement::getCodeForFORloopOrSimpleInitCode($key,
             $masterArrayKey,$val,$space);

          }else{

          $resultString.='$'.$masterArrayKey.'["'.$key.'"] = $data["'.$key.'"];'."\n\n";

          }


    }


    echo $resultString;
    }



    //the method below outputs the for loop or simple data initialization code
//depending if it is array or simple variable
public static function getCodeForFORloopOrSimpleInitCode($key,
$masterArrayKey,
$var,$space){
    $space .= "         ";
    if($masterArrayKey==="0"){
      $masterArrayKey = "zero";
    }

    if($key=="0"){
      $key="zero";
    }
    else if($key==='0'){
        $key="zero";
    }
    $realMasterArrayKey =$masterArrayKey. "['".$key."']";
    $resultString = "";

    if(is_array($var)){


    //$resultString .= $space.'$'.$key.' = array();//newly prepared data array to be put as josn'."\n";//$key.'_data_array
    $resultString .= $space.'$'.$key.'_array = array();//newly prepared data array to be put in json'."\n";//$key.'_data_array
     $resultString .= $space.'$'.$key.'_data_array = array();//data fetched drom database'."\n";


  $resultString.="\n".$space.'foreach($'.$key.'_data_array as $'.$key.'_key=>$'.$key.'_val){'."\n";
        foreach($var as $key_in=>$var_in){
            if($key_in>=1){ break;}

    $resultString .=  Statement::getCodeForFORloopOrSimpleInitCode($key_in,
    $key.'_array',$var_in,$space);


        }

          $resultString.=$space.'}'."\n";

           $resultString.=$space.'$'.$realMasterArrayKey.''.' = $'.$key.'_array;'."\n"."\n";
    }else{

    $resultString.="\n".$space.'$'.$realMasterArrayKey.' = $'.str_replace("_array","",$masterArrayKey).'_val["'.$key.'"];'."\n"."\n";

    }

    return $resultString;
}


}
