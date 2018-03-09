<?php

namespace App\Http\Controllers\Laravel\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Laravel\Page\Pagegenerator as PageGenerate;

use App\Http\Controllers\Laravel\Javascript\Javascript as Javascript;


class Pagegenerator extends Controller
{
    //
    public static function createSimpleGetPagePage($array){

    $resultString = "";

    $functionPath = $array['functionPath'];
    $controllerName = explode("/",$functionPath)[sizeof(explode("/",$functionPath))-2];


    $functionName = explode("/",$functionPath)[sizeof(explode("/",$functionPath))-1];;
    $pathArray = explode("/",$functionPath);
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

    //the method below returns the blade code for adding data
    public static function getBladeForAddingData($colNames){


        $resultString ='//the code below is to show add form'."\n";

        $resultString.='<form action="{{ url(\'/\') }}/super_admin/documents/add" method="post" >'."\n";
        $resultString.='            <input type="hidden" name="_token" value="{{ csrf_token() }}">'."\n";
        $resultString.='            <div class="row">'."\n";
       

        foreach ($colNames as $key => $value) {
          # code...
           $resultString.='              <div ><b> Document Name : </b> <input type="text" name="'.$value.'" id="'.$value.'_field" value="{{old(\''.$value.'\') }}"></div>'."\n";
        }
       
        $resultString.='              <br>'."\n";
        $resultString.='              <button type="submit" class="btn btn-primary" id="add_btn">ADD</button>'."\n";
        $resultString.='            </div>'."\n";
        $resultString.=''."\n";
        $resultString.=''."\n";
        $resultString.='          </form >'."\n";

        return $resultString;

    } 


    //the method below gets the blade for editing data
    public static function getBladeForEditingData($colNames){

        $resultString ='//the code below is to show edit form'."\n";
        $resultString.='<form action="{{ url(\'/\') }}/super_admin/documents/add" method="post" >'."\n";
        $resultString.='            <input type="hidden" name="_token" value="{{ csrf_token() }}">'."\n";
        $resultString.='            <div class="row">'."\n";
       

        foreach ($colNames as $key => $value) {
          # code...
            $resultString.='<input type="text" name="'.$value.'" value="@if(Session::has(\'validate_mode\')) {{ old(\''.$value.'\')  }} @else{{ $create_apply_data->'.$value.' }} @endif" style="position:relative;left:241px;"></input>'."\n";
            $resultString.='                              @if($errors->has(\''.$value.'\')) <p style="color: red;">{{$errors->first(\''.$value.'\')}}</p>@endif'."\n";

        }
       
        $resultString.='              <br>'."\n";
        $resultString.='              <button type="submit" class="btn btn-primary" id="edit_btn">EDIT</button>'."\n";
        $resultString.='            </div>'."\n";
        $resultString.=''."\n";
        $resultString.=''."\n";
        $resultString.='          </form >'."\n";

        return $resultString;

    }


    //the method below returns the view for viewing the list
    public static function getBladeForList($table_name,$main_route){

        $resultString ='//the code below is to show the list'."\n";
        $resultString.='<table class="table table-striped" style="">'."\n";
        $resultString.='  <thead  style="">'."\n";
        $resultString.='    <tr>'."\n";
        $resultString.='     <td style="position: relative;left:0px; ">S.NO.</td>'."\n";
        $resultString.='      <td style="font-size:15px;font-weight:bold;">Edit</td>'."\n";
        $resultString.='      <td style="font-size:15px;font-weight:bold;">Delete</td>      '."\n";
        $resultString.='    </tr>'."\n";
        $resultString.='  </thead>'."\n";
        $resultString.='  <tbody>'."\n";
        $resultString.=''."\n";
        $resultString.='    @foreach($'.$table_name.' as $table_data)'."\n";
        $resultString.=''."\n";
        $resultString.='          <tr>'."\n";
        $resultString.='            <th scope="row">{{ $table_data->id }}</th>'."\n";
        $resultString.='            <td><a href="{{ url(\'/\') }}/'.$main_route.'/edit/{{ $table_data->id }}" type="button" class="btn btn-primary">Edit</a></td>'."\n";
        $resultString.='          <td><a href="{{ url(\'/\') }}/'.$main_route.'/delete/{{ $table_data->id }}" type="button" class="btn btn-danger">Delete</a></td>'."\n";
        $resultString.='          </tr>'."\n";
        $resultString.=''."\n";
        $resultString.='    @endforeach'."\n";
        $resultString.='    '."\n";
        $resultString.=''."\n";
        $resultString.='  </tbody>'."\n";
        $resultString.='</table>'."\n";

        return $resultString;

    }

    public static function createAjaxCodes($val){

        $codes = Javascript::prepareTotalAjaxCodes($val);

        return $codes;
    }


}
