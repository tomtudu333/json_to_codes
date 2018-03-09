<?php

namespace App\Http\Controllers\Laravel\Javascript;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Laravel\Javascript\Javascript as Javascript;

class Javascript extends Controller
{
    //

    //the method below retursn the code for ajax
    public static function getCodeForAjax($cols, $url){

    		//get route for ajax


    	      $resultString ='			$.ajax({'."\n";
			  $resultString.='                type: \'POST\','."\n";
			  $resultString.='                dataType: \'html\','."\n";
			  $resultString.='                url: "{{ url(\'/\') }}'.$url.'",'."\n";
			  $resultString.='                data: {'."\n";

		    	foreach ($cols as $key => $value) {
		    		$resultString.='               		'.$value.':'.$value.', '."\n";
		    	}
			  $resultString.='                    '."\n";
			  $resultString.='                },'."\n";
			  $resultString.='                cache: false'."\n";
			  $resultString.='                }).done(function (data) {'."\n";
			  $resultString.=''."\n";
			  $resultString.='                           console.log(data);'."\n";
			  $resultString.='                }).fail('."\n";
			  $resultString.=''."\n";
			  $resultString.='                function(data, textStatus, xhr) {'."\n";
			  $resultString.='                 //This shows status code eg. 403'."\n";
			  $resultString.='                 console.error("error", data.status);'."\n";
			  $resultString.='            }'."\n";
			  $resultString.=''."\n";
			  $resultString.='            );'."\n";


		  return $resultString;

    }

    //the method below gets the php function for ajax
    public static function getPhpFunctionForAjax($functionName, $className , $url, $cols){



    	  $resultString ='Route::post(\''.$url.'\',\''.$className.'@'.$functionName.'\');'."\n";

    	  $resultString .='//the method below adds a document name'."\n";
		  $resultString.='    public function functionName(Request $request){'."\n";
		  $resultString.=''."\n";
		  
    	  foreach ($cols as $key => $value) {
    	  	$resultString.='    	$'.$value.' = $request->input(\''.$value.'\');'."\n";
    	  }

		  $resultString.='    	'."\n";

    	  
    	  foreach ($cols as $key => $value) {
    	  	$resultString.='    	 $userDocName->'.$value.' = $'.$value.';'."\n";
    	  }

		  $resultString.=''."\n";
		  $resultString.='    	 $userDocName->save();'."\n";
		  $resultString.=''."\n";
		  $resultString.='    	 return response()->json([\'result\'=>\'true\'], 201);'."\n";
		  $resultString.='    }'."\n";

		  return $resultString;

    }

    //the method below prepares all ajax codes url etc
    public static function prepareTotalAjaxCodes($array){

    	$functionName = $array['function_name'];

    	$className = $array['class_name'];

    	$url = $array['url'];

    	$cols = $array['cols'];

    	$ajaxCode = Javascript::getCodeForAjax($cols, $url);

    	$phpFunctionCode = Javascript::getPhpFunctionForAjax($functionName, $className , $url, $cols);

    	$allCodes = $ajaxCode.$phpFunctionCode;

    	return $allCodes;
    }
}
