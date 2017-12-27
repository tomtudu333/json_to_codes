<?php

namespace App\Http\Controllers\Java\Statement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Statement extends Controller
{
    //

    public static function createTableInfoCodes($array){

$resultString = "";
$tableName = $array['tableName'];
$databaseName = $array["databaseName"];

$cols = $array["cols"];
//var_dump($cols);
$resultString.='public static abstract class TableInfo implements BaseColumns {
'."\n";

foreach ($cols as $value) {
  # code...
  $resultString .='        public static final String '.$value.' = "'.$value.'";
'."\n";
}

  $resultString.='public static final String databaseName = "'.$databaseName.'";
'."\n";
  $resultString.='
'."\n";
  $resultString.='        public static final String tableName = "'.$tableName.'";'."\n";


$i=0;

$resultString.='        public static final String[] colsToReturnWithoutId = {
'."\n";
foreach ($cols as $value) {
      if($i==0){
                  $resultString.='        TableInfo.'. $value.'
          '."\n";
      }else{
                $resultString.='        ,TableInfo.'. $value.'
        '."\n";
      }
    $i++;
}
  $resultString.='          };
'."\n";
  $resultString.='        public static final String[] colsToReturnWithId = {"id",
'."\n";

$i=0;
foreach ($cols as $value) {
      if($i==0){
                  $resultString.='        TableInfo.'. $value.'
          '."\n";
      }else{
                $resultString.='        ,TableInfo.'. $value.'
        '."\n";
      }
    $i++;
}

  $resultString.='               };'."\n";

return $resultString;
    }


//the method below gets the form view for android form activity
    public static function getFormView($array){

    $fields = $array['fields'];

    $resultString ="";
    $marginLeft = 108;
    $marginTop = 0;
    $marginStart = 108;

    //echo $marginLeft;

    foreach ($fields as $key => $value) {
  $fieldName = $value['fieldName'];
  $fieldTyoe = $value['fieldType'];

//echo '<';

$resultString.='<';
  $resultString.='TextView'."\n";
  //$resultString.='<T';
  $resultString.='                android:text="Some text"'."\n";
  $resultString.='                android:layout_width="wrap_content"'."\n";
  $resultString.='                android:layout_height="wrap_content"'."\n";
  $resultString.='                android:layout_alignParentTop="true"'."\n";
  $resultString.='                android:layout_alignParentLeft="true"'."\n";
  $resultString.='                android:layout_alignParentStart="true"'."\n";
  $resultString.='                android:layout_marginLeft="'.$marginLeft.'dp"'."\n";
  $resultString.='                android:layout_marginTop="'.$marginTop.'dp"'."\n";
  $resultString.='                android:layout_marginStart="'.$marginStart.'dp"'."\n";
  $resultString.='                android:id="@+id/'.$fieldName.'_textview" />'."\n";

//$resultString.="TextView";
//echo 'The resultstring - '.$resultString;
  $marginTop+=60;

 switch ($fieldTyoe) {
    case 'editText':
        $resultString.='<EditText'."\n";
        $resultString.='                android:text="Some text"'."\n";
        $resultString.='                android:layout_width="wrap_content"'."\n";
        $resultString.='                android:layout_height="wrap_content"'."\n";
        $resultString.='                android:layout_alignParentTop="true"'."\n";
        $resultString.='                android:layout_alignParentLeft="true"'."\n";
        $resultString.='                android:layout_alignParentStart="true"'."\n";
        $resultString.='                android:layout_marginLeft="'.$marginLeft.'dp"'."\n";
        $resultString.='                android:layout_marginTop="'.$marginTop.'dp"'."\n";
        $resultString.='                android:layout_marginStart="'.$marginStart.'dp"'."\n";
        $resultString.='                android:id="@+id/'.$fieldName.'_editext" />'."\n";

    break;

    case 'button':
    $resultString.='<Button'."\n";
    $resultString.='                android:text="Some text"'."\n";
    $resultString.='                android:layout_width="wrap_content"'."\n";
    $resultString.='                android:layout_height="wrap_content"'."\n";
    $resultString.='                android:layout_alignParentTop="true"'."\n";
    $resultString.='                android:layout_alignParentLeft="true"'."\n";
    $resultString.='                android:layout_alignParentStart="true"'."\n";
    $resultString.='                android:layout_marginLeft="'.$marginLeft.'dp"'."\n";
    $resultString.='                android:layout_marginTop="'.$marginTop.'dp"'."\n";
    $resultString.='                android:layout_marginStart="'.$marginStart.'dp"'."\n";
    $resultString.='                android:id="@+id/'.$fieldName.'_button" />'."\n";

    break;

    case 'spinner':
    $resultString.='<Spinner'."\n";
    $resultString.='                android:text="Some text"'."\n";
    $resultString.='                android:layout_width="wrap_content"'."\n";
    $resultString.='                android:layout_height="wrap_content"'."\n";
    $resultString.='                android:layout_alignParentTop="true"'."\n";
    $resultString.='                android:layout_alignParentLeft="true"'."\n";
    $resultString.='                android:layout_alignParentStart="true"'."\n";
    $resultString.='                android:layout_marginLeft="'.$marginLeft.'dp"'."\n";
    $resultString.='                android:layout_marginTop="'.$marginTop.'dp"'."\n";
    $resultString.='                android:layout_marginStart="'.$marginStart.'dp"'."\n";
    $resultString.='                android:id="@+id/'.$fieldName.'_spinner" />'."\n";

    break;

    case 'datepicker':
    $resultString.='<Button'."\n";
    $resultString.='                android:text="Some text"'."\n";
    $resultString.='                android:layout_width="wrap_content"'."\n";
    $resultString.='                android:layout_height="wrap_content"'."\n";
    $resultString.='                android:layout_alignParentTop="true"'."\n";
    $resultString.='                android:layout_alignParentLeft="true"'."\n";
    $resultString.='                android:layout_alignParentStart="true"'."\n";
    $resultString.='                android:layout_marginLeft="'.$marginLeft.'dp"'."\n";
    $resultString.='                android:layout_marginTop="'.$marginTop.'dp"'."\n";
    $resultString.='                android:layout_marginStart="'.$marginStart.'dp"'."\n";
    $resultString.='                android:id="@+id/'.$fieldName.'datepicker" />'."\n";

    break;

    case 'timepicker':
    $resultString.='<Button'."\n";
    $resultString.='                android:text="Some text"'."\n";
    $resultString.='                android:layout_width="wrap_content"'."\n";
    $resultString.='                android:layout_height="wrap_content"'."\n";
    $resultString.='                android:layout_alignParentTop="true"'."\n";
    $resultString.='                android:layout_alignParentLeft="true"'."\n";
    $resultString.='                android:layout_alignParentStart="true"'."\n";
    $resultString.='                android:layout_marginLeft="'.$marginLeft.'dp"'."\n";
    $resultString.='                android:layout_marginTop="'.$marginTop.'dp"'."\n";
    $resultString.='                android:layout_marginStart="'.$marginStart.'dp"'."\n";
    $resultString.='                android:id="@+id/'.$fieldName.'_timepicker" />'."\n";

    break;

    default:
      # code...
      break;
  }
}

    return $resultString;
}


}
