<?php

namespace App\Http\Controllers\Laravel\Statement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Statement extends Controller
{
    //

//method to increas functionality the statement
    public static function increaseFunctionality($array){
    $classpath = $array['classPath'];
    $functionName = $array['functionName'];
    $resultString = "";
    //$classpath = str_replace("\\","\\\\",$classpath);
    $resultString.='use App\\Http\\Controllers\\'.$classpath."\n";

    $className = explode("\\",$classpath)[sizeof(explode("\\",$classpath))-1];

  $resultString.='//php case code'."\n";
    //get case
    $resultString.='            case \''.$functionName.'\':'."\n";
    $resultString.='            $code = '.$className.'::'.$functionName.'($val);'."\n";
    $resultString.='            break;'."\n";
    $resultString.="\n";
    $resultString.="\n";
    $resultString.='//php code for the function'."\n";
    $resultString.='public static function '.$functionName.'(){'."\n";
    $resultString.='    '."\n";
    $resultString.='    $resultString = "";'."\n";
    $resultString.='    '."\n";
    $resultString.='    return $resultString;'."\n";
    $resultString.='}'."\n";

    $resultString.="\n";
    $resultString.="\n";
    $resultString.='//html code for option'."\n";
    //get option html code
    $resultString.='<option>'.$functionName.'</option>'."\n";


    return $resultString;
}

//php code for the function
public static function createForLoopPhp($array){

    $resultString = "";

$fields = $array['fields'];
//var_dump($fields);
$resultString = '';
$seperatedBy = $array['seperated_by'];

$stringNvars = $array['stringNvars'];

//var_dump($stringNvars);
$stringVarArray = explode('{}',$stringNvars);
//var_dump($stringVarArray);
$i=0;
$stringToBeLooped = '$resultString.=';
foreach($stringVarArray as $val){

  //var_dump($val);
  if($i==0){
    if($val==""){
      $stringToBeLooped.="''";
  }else{
      $stringToBeLooped.="'".$val."'";
  }
  }else{
      if($val==""){
      $stringToBeLooped.=".''";
  }else{
      $stringToBeLooped.=".'".$val."'";
  }
  }

  if($i<sizeof($stringVarArray)-1){
      if($i==0){
     $stringToBeLooped.='.$val';
  }else{
       $stringToBeLooped.='.$val';
  }
  }

  $i++;

}
$i=0;

  $resultString.='$i=0;'."\n";
  $resultString.='foreach($array as $val){'."\n";
  $resultString.='    '."\n";
  $resultString.='    if(sizeof($array)-1==$i){'."\n";
  $resultString.='        '."\n";
  //no seperator to be added
  $resultString.=$stringToBeLooped.";";
  $resultString.='    }else{'."\n";
  $resultString.='        '."\n";
  //seperator to be added infront
  $resultString.=$stringToBeLooped.".".'"'.$seperatedBy.'"'.";";

  $resultString.='    }'."\n";
  $resultString.='    $i++;'."\n";
  $resultString.='    '."\n";
  $resultString.='}'."\n";
  $resultString.=''."\n";
  $resultString.='$i=0;'."\n";



//echo $resultString;
    return $resultString;
}


//the method below creates the for loop
public static function createForLoopTwo($stringNvars,$variableName){
  //$stringNvars = $array['stringNvars'];
  $seperatedBy = explode("||",$stringNvars)[1];
  $resultString = "";

  $realStringnVars = explode("||",$stringNvars)[0];
  //var_dump($stringNvars);
  $stringVarArray = explode('{}',$realStringnVars);
  //var_dump($stringVarArray);
  $i=0;
  $stringToBeLooped = $variableName.'.=';
  foreach($stringVarArray as $val){

    //var_dump($val);
    if($i==0){
      if($val==""){
        $stringToBeLooped.="''";
    }else{
        $stringToBeLooped.="'".$val."'";
    }
    }else{
        if($val==""){
        $stringToBeLooped.=".''";
    }else{
        $stringToBeLooped.=".'".$val."'";
    }
    }

    if($i<sizeof($stringVarArray)-1){
        if($i==0){
       $stringToBeLooped.='.$val';
    }else{
         $stringToBeLooped.='.$val';
    }
    }

    $i++;

  }
  $i=0;

    $resultString.=$variableName." = '';".'$i=0;'."\n";
    $resultString.='foreach($fields as $val){'."\n";
    $resultString.='    '."\n";
    $resultString.='    if(sizeof($fields)-1==$i){'."\n";
    $resultString.='        '."\n";
    //no seperator to be added
    $resultString.=$stringToBeLooped.";";
    $resultString.='    }else{'."\n";
    $resultString.='        '."\n";
    //seperator to be added infront
    $resultString.=$stringToBeLooped.".".'"'.$seperatedBy.'"'.";";

    $resultString.='    }'."\n";
    $resultString.='    $i++;'."\n";
    $resultString.='    '."\n";
    $resultString.='}'."\n";
    $resultString.=''."\n";
    $resultString.='$i=0;'."\n";



  //echo $resultString;
      return $resultString;
}



}
