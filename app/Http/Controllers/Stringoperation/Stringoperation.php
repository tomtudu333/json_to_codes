<?php

namespace App\Http\Controllers\Stringoperation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Stringoperation extends Controller
{
    //

    //the method below gets total number of sreing matches and other details
    //from string
    public static function getStringMatchesAndOtherDetails($string){

      $chars = str_split($string);
      var_dump(strlen($string));
      var_dump(strlen($string)%2);

      $halfTheStringSize = (strlen($string)-strlen($string)%2)/2;
      var_dump($halfTheStringSize);
      //
      $matchesDataArray = array();

      for($z=1;$z<=$halfTheStringSize;$z++){

          for($i=0;$i<strlen($string);$i++){

          $currentChar = substr($string,$i,$z);
          $matchFound = false;
          //echo $currentChar;

          for($q=0;$q<strlen($string);$q++){
              $currentCharQ = substr($string,$q,$z);
              //echo $currentChar." -- ".$currentCharQ.$i." ".$q."\n";
              if($i==$q){}else{
                  if($currentChar==$currentCharQ){
                  $matchFound = true;
                 //echo $currentChar." : ".$i." ".$q." ";
                 //$matches = array($currentChar=>[$i,$q]);//[$currentChar=>[$i,$q]];
                 //var_dump($matches);
                 $matches = [$currentChar,$i,$q];
                 //$matchesDataArray[$currentChar] = [$i,$q];
                 array_push($matchesDataArray,$matches);
              }
              }
          }

          //  if($matchFound){
          //      echo "\n";
          //  }

      }
      }

      $wordPresentTimes = 0;
      //now the unlinking of objects from the collection of matches
      foreach($matchesDataArray as $key => $value){

          $currentChar = $value[0];
          $wordPresentTimes = 0;
         //var_dump($value);
          foreach($matchesDataArray as $key_in => $value_in){
           $currentCharIn = $value_in[0];
           //var_dump($value_in[0][0]);
           //echo $currentCharIn;
          if(strlen($currentChar)>strlen($currentCharIn)){
              $strinFound = strpos($currentChar,$currentCharIn);
              if(strlen($strinFound)>=1){
                  //echo "unsetting - ".$key_in."\n";
                   unset($matchesDataArray[$key_in]);

              }
          }

          }

      }

      $key_array = array();
      //final loop to count the number of occurences
      foreach($matchesDataArray as $key=>$value){


         if(isset($key_array[$value[0]])){
              //echo $value[1]."\n";
            $key_array[$value[0]]["total_occurence"] = $key_array[$value[0]]["total_occurence"]+1;

          if(in_array($value[1],$key_array[$value[0]]["places"])){}else{
              array_push( $key_array[$value[0]]["places"],$value[1]);
          }


         }else{
             echo "The value - ".$value[1];
             $key_array[$value[0]] = ["total_occurence"=>1,"places"=>[$value[1]]];

         }

      }

      return $key_array;
    }
}
