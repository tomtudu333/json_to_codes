<?php

namespace App\Http\Controllers\Laravel\Classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Classes extends Controller
{
    //

    //generate code for public static functions that returns result string
    public static function getPubFuncRScode(){

      $resultString = "";
      $resultString.='public static function functionName(){'."\n";
      $resultString.='    '."\n";
      $resultString.='    $resultString = "";'."\n";
      $resultString.='    '."\n";
      $resultString.='    return $resultString;'."\n";
      $resultString.='}'."\n";

      return $resultString;
    }
}
