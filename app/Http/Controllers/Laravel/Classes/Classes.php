<?php

namespace App\Http\Controllers\Laravel\Classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Laravel\Classes\Classes as Classes;
use App\Http\Controllers\Laravel\Page\Pagegenerator as Pagegenerator;

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

 
    //the method below returns the php code for adding the data
    public static function getCodeForAddingData($model_name, $cols){



          $resultString ='//method for adding data'."\n";
          $resultString.='public function addData(Request $request){'."\n";
          $resultString.='    '."\n";

          $resultString .='$'.$model_name.' = new '.$model_name.'();'."\n";
          foreach ($cols as $key => $value) {
            $resultString.='$createApply->'.$value.' =$request->input(\''.$value.'\');'."\n";
          }
          $resultString.=''."\n";
          $resultString.='$createApply->save();'."\n";

          $resultString.='}'."\n";

          return $resultString;

    }


    //the method below is the code validate and save
    public static function getCodeForValidateAndSave($mode,$cols,$main_route){
        $resultString ='public function validateAndSave(Request $request){'."\n";
        $resultString.='      '."\n";
        $resultString.='      if($this->validate_form($request)){'."\n";
        $resultString.='        //save the data'."\n";
        $resultString.='        $this->saveData($request);'."\n";
        $resultString.='//        echo "Data saved !";'."\n";
        $resultString.='      }else{'."\n";
        $resultString.=''."\n";
        $resultString.='        return redirect(\'/'.$main_route.'/add-form\')->withErrors($this->validator)->withInput()->send();'."\n";
        $resultString.='      }'."\n";
        $resultString.=''."\n";
        $resultString.='    }'."\n";

        return $resultString;

    }

    //the method below returns the code updating the data
    public static function getCodeForEditingData($model_name, $cols){

        $resultString ='//method to edit data'."\n";
        $resultString .='public function editData(Request $request){'."\n";
        $resultString.='    '."\n";


         $resultString .='$'.$model_name.' = '.$model_name.'::find($request->input(\'id\'));'."\n";

          foreach ($cols as $key => $value) {
            $resultString.='$createApply->'.$value.' =$request->input(\''.$value.'\');'."\n";
          }
          $resultString.=''."\n";
          $resultString.='$createApply->save();'."\n";

          $resultString.='}'."\n";


          return $resultString;
    }

    //the method below gets the code for validation
    public static function getCodeForValidation($cols){

          $resultString ='//method to validate data'."\n";
          $resultString.='public function validate(Request $request){'."\n";
          $resultString.='    '."\n";
          


        $resultString .='$rules=array('."\n";
        $resultString.=''."\n";
        foreach ($cols as $key => $value) {
          $resultString.='        \''.$value.'\'=>\'required\','."\n";
        }
        $resultString.=''."\n";
        $resultString.='      );'."\n";



          $resultString.='$message=array('."\n";

          foreach ($cols as $key => $value) {
            $resultString.='            \'form_id\'=>\'Form is required.\','."\n";
          }
          $resultString.=''."\n";
          
          $resultString.='      );'."\n";

          $resultString.='$this->validator=Validator::make($request->all(),$rules,$message);'."\n";
          $resultString.='      if($this->validator->fails())'."\n";
          $resultString.='      {'."\n";
          $resultString.='        $request->session()->flash(\'validate_mode\', \'true\');'."\n";
          $resultString.='        return false;'."\n";
          $resultString.='      }'."\n";
          $resultString.='      else'."\n";
          $resultString.='      {'."\n";
          $resultString.='        return true;'."\n";
          $resultString.='      }'."\n";

          $resultString.='private $validator = \'\';'."\n";



          return $resultString;

          $resultString.='}'."\n";

    }

    //the method below returns the code for deleting the data
    public static function getCodeForDeletingData($model){


        $resultString ='//the method below deletes the data'."\n";
        $resultString.='public function deleteData($id){'."\n";
        $resultString.='    '."\n";
        $resultString .='$doc = '.$model.'::find($id);'."\n";
        $resultString.='     '."\n";
        $resultString.='$doc->delete();'."\n";

        $resultString.='}'."\n";

        return $resultString;

    }

    //the method below returns the code for showing the list
    public static function getCodeForShowingList($model){

        $resultString ='//show data list'."\n";
        $resultString.='public function showList(Request $request){'."\n";

        $resultString .='$'.$model.' = '.$model.'::all();'."\n";
        $resultString.=''."\n";
        $resultString.='return view(\'super_admin.super_admin_createapply_list\',[\''.$model.'\'=>$'.$model.']);'."\n";

        $resultString.='}'."\n";

        return $resultString;

    }

    //the method below gets the code for showing add form
    public static function getCodeForShowingAddForm($model){

      $resultString='//show add form'."\n";
      $resultString.='public function showAddForm(Request $request){'."\n";
      $resultString .='return view("super_admin.super_admin_createapply");'."\n";
      $resultString.='}'."\n";

      return $resultString;
    }

    //the method below gets the code for showing edit form
    public static function getCodeForShowingEditForm($model){

        $resultString ='//show edit form'."\n";
        $resultString.='public function showEditForm(Request $request){'."\n";
        $resultString .='$'.$model.' = '.$model.'::find($id);'."\n";
        $resultString.='        return view(\'super_admin.super_admin_createapply_edit\', '."\n";
        $resultString.='        [\''.$model.'_data\'=>$'.$model.' ]'."\n";
        $resultString.='        );'."\n";
        $resultString.='}'."\n";

        return $resultString;

    }

    //the method below gets the codes for route
    public static function getCodeForRoutes($main_route){
        $resultString ='Route::get(\'/'.$main_route.'/add-form\', \'super_admin\super_admin_createapply_c@showCreateApplyForm\');'."\n";
        $resultString.=''."\n";
        $resultString.='Route::get(\'/'.$main_route.'/delete/{id}\',\'super_admin\super_admin_createapply_c@delete\')'."\n";
        $resultString.=''."\n";
        $resultString.='        //add the create apply data'."\n";
        $resultString.='Route::post(\'/'.$main_route.'/add\',\'super_admin\super_admin_createapply_c@addData\');'."\n";
        $resultString.=''."\n";
        $resultString.='        //edit the create apply data'."\n";
        $resultString.='Route::get(\'/'.$main_route.'/edit/{id}\',\'super_admin\super_admin_createapply_c@validateAndUpdate\');'."\n";
        $resultString.=''."\n";
        $resultString.='        //create apply'."\n";
        $resultString.='Route::get(\'/'.$main_route.'/list\', \'super_admin\super_admin_createapply_c@showCreateApplyList\');'."\n";

        return $resultString;
    }



    public static function addEditDeleteCode($array){

      $table_name = $array['table_name'];

      $cols = $array['cols'];
      $main_route = $array['main_route'];
      

      $codeForShowingAddForm = Classes::getCodeForShowingEditForm($table_name);
      $codeForShowingEditForm = Classes::getCodeForShowingEditForm($table_name);
      
      $codeForShowingList = Classes::getCodeForShowingList($table_name);
      $codeForDeletingData = Classes::getCodeForDeletingData($table_name);
      $codeForValidation = Classes::getCodeForValidation($cols);
      $codeForEditingData = Classes::getCodeForEditingData($table_name, $cols);
      $codeForAddingData = Classes::getCodeForAddingData($table_name, $cols);  
      $codeForValidateAndSave = Classes::getCodeForValidateAndSave($table_name,$cols,$main_route);

      $routeCodes = Classes::getCodeForRoutes($main_route);


      //views
      $viewForAdding = Pagegenerator::getBladeForAddingData($cols);
      $viewForEditing = Pagegenerator::getBladeForEditingData($cols);
      $viewForShowingList = Pagegenerator::getBladeForList($table_name, $main_route);

      $resultString = $codeForValidateAndSave.$codeForAddingData.$codeForDeletingData.$codeForEditingData.$codeForValidation.$codeForShowingAddForm.$codeForShowingEditForm.$routeCodes.$viewForAdding.$viewForEditing.$viewForShowingList;
        return $resultString;
    }

}
