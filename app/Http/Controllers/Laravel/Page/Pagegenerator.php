<?php

namespace App\Http\Controllers\Laravel\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Laravel\Page\Pagegenerator as PageGenerate;

class Pagegenerator extends Controller
{
    //
    public static function createSimpleGetPagePage($array){

    $resultString = "";

    $functionPath = $array['functionPath'];
    $controllerName = explode("\\",$functionPath)[sizeof(explode("\\",$functionPath))-2];


    $functionName = explode("\\",$functionPath)[sizeof(explode("\\",$functionPath))-1];;
    $pathArray = explode("\\",$functionPath);
    $viewName = implode(".",$pathArray);
    $resultString .= PageGenerate::getRouteCode(  $pathArray,$functionName);

    $resultString .= PageGenerate::getViewFunction($functionName,$viewName);

    $resultString .= PageGenerate::getBladeView();

    return $resultString;
    }

    //the method below returns the route
    public static function getRouteCode($pathArray,$functionName){


      $resultString = "";
      $controllerNameSlash = implode("/",$pathArray);
      $controllerName = $pathArray[sizeof($pathArray)-2];
      $realControllerNameSlash = "";
      $realControllerNameDot = "";
      $i=0;
      foreach ($pathArray as $value) {
        if($i==0){
          $realControllerNameSlash.=$value;
        }else{
          $realControllerNameSlash.="/".$value;
        }
         $i++;
      }

      $i=0;
      foreach ($pathArray as $value) {

        if($i>=(sizeof($pathArray)-2)){}else{
          if($i==0){
            $realControllerNameDot.=$value;
          }else{
            $realControllerNameDot.="\\".$value;
          }
        }

         $i++;
      }


      $controllerNameDot = implode(".",$pathArray);
      $resultString.='Route::get(\'/'.$realControllerNameSlash.'\',\''.$realControllerNameDot.'\\'.ucwords($controllerName).'@'.$functionName.'\');'."\n";

      return $resultString;
    }

    //the method below returns the Controller function
    public static function getViewFunction($functionName,$viewName){

$resultString = "";
      $resultString.='  public function '.$functionName.'(){'."\n";
$resultString.=''."\n";
$resultString.='        return view(\''.$viewName.'\');'."\n";
$resultString.='  }'."\n";

return $resultString;

    }

    //the method below returns the code for blade
    public static function getBladeView(){


      $resultString = "";

  $resultString.='@extends(\'layouts.app\')
';
  $resultString.='
';
  $resultString.='@section(\'content\')
';
  $resultString.='<div class="container">
';
  $resultString.='
';
  $resultString.='</div>
';
  $resultString.='@endsection';

return $resultString;

    }


}
