<?php

namespace App\Http\Controllers\Library\String;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Library\String\Stringoperation;

class Stringoperation extends Controller
{
    //

    //the method below finds the positions of string in long string
    public static function getOccurencePosesInString($thingToFind,$findIn){

      $html =$findIn;
$needle = $thingToFind;
$lastPos = 0;
$positions = array();

while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
    $positions[] = $lastPos;
    $lastPos = $lastPos + strlen($needle);
}

return $positions;
    }


    //the method below finds for the codeblocks in string
    public static function findCOdeBlocksInString($openBrace,$closedBrace,$findIn){


      $openBraceOccurences = Stringoperation::getOccurencePosesInString($openBrace,$findIn);
      $closeBraceOccurences = Stringoperation::getOccurencePosesInString($closedBrace,$findIn);

      $blockOccurences = array();


      for($i=0;$i<sizeof($openBraceOccurences);$i++){

        $currentOpos = $openBraceOccurences[$i];
        //$currentOpos = $currentOpos+3;
        if(isset($closeBraceOccurences[$i])){
          $currentCPos = $closeBraceOccurences[$i];

          if($currentOpos<$currentCPos){

            array_push($blockOccurences,[$currentOpos,$currentCPos,
          substr($findIn,$currentOpos+1,$currentCPos-($currentOpos+1))]);
          }

        }
      }

      return $blockOccurences;
    }
}
