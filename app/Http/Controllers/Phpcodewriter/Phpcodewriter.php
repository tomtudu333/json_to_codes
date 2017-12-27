<?php

namespace App\Http\Controllers\Phpcodewriter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Phpcodewriter\Phpcodewriter as Phpwriter;

class Phpcodewriter extends Controller
{
    //

    //the method below writs the php code to the file
    public static function writePhpCodestoFile($phpCode,$file){


          //$my_file = '../app/Http/Controllers/Controller007.php';
          $handle = fopen($file, 'w') or die('Cannot open file:  '.$file);
          $data = $phpCode;
          //$finalcode = Phpwriter::prepareClassCodes($data);//Phpwriter
          fwrite($handle, $data);
    }

    //the method below prepares the class code
    public static function prepareClassCodes($functionCodes){

      $resultString = "";

      $resultString.='<?php'."\n";
      $resultString.=''."\n";
      $resultString.='namespace App\\Http\\Controllers\\Phpcodetest;'."\n";
      $resultString.=''."\n";
      $resultString.='use Illuminate\\Http\\Request;'."\n";
      $resultString.='use App\\Http\\Controllers\\Controller;'."\n";
      $resultString.=''."\n";
      $resultString.='class Phpcodetest extends Controller'."\n";
      $resultString.='{'."\n";
      $resultString.='    //'."\n";
      $resultString.=''."\n";
      $resultString.='    public function test(){'."\n";
      $resultString.=$functionCodes;
      $resultString.=''."\n";

      $resultString.='}'."\n";
      $resultString.='}'."\n";

      return $resultString;
    }


    //the method below write intervals
    public static function writeIntervals($intervalStatement){
      $resultString = "";
      $resultString.='//'."\n";
$resultString.='//'."\n";
$resultString.='//'."\n";
$resultString.='//'."\n";
$resultString.='////////////////////////////////////////////////////////////////////////'."\n";
$resultString.='////////////////////////////////////////////////////////////////////////'."\n";
$resultString.='////////////////////////////////////////////////////////////////////////'."\n";
$resultString.='//'.$intervalStatement."\n";

return $resultString;

    }
}
