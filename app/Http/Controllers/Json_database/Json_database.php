<?php
namespace App\Http\Controllers\Json_database;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\json_table;
use Validator;
class Json_database extends Controller
{
    //




    public function validateAndUpdate(Request $request){
      
      if($this->validate_form($request)){
        //save the data
        $this->editData($request);
//        echo "Data saved !";
      }else{

        return redirect('/json_database/add-form')->withErrors($this->validator)->withInput()->send();
      }

    }
	//method for adding data
	public function addData(Request $request){
	    
		$json_table = new json_table();

		// echo $request->input('json_table_data');
		$json_data = $this->createTableJson($request->input('json_table_data')); 



		// echo $json_data;
		$json_table->json_table_data = $json_data;
		$json_table->database_name =$request->input('database_name');

		$json_table->save();
	}



    //php code for the function
	public static function createTableJson($data){
	    
	    $data = str_replace("\r\n", "\n", $data);
	    $rawData = explode("\n",$data);

	    //var_dump($rawData);

	    $resultArray = array();
	    $currentTableName = "";
	    foreach ($rawData as $key => $value) {

	    	//if the siring exists, add to coloumn
	    	if(preg_match('/\s/',$value)>0){
	    		
	    		//is a coloumn name
	    		$currentColoumnName = $value;
	    		//var_dump(strlen("	"));
	    		if(strlen(ltrim($currentColoumnName))<1){
					
	    		}else{
	    			$resultArray[$currentTableName][] = ltrim($currentColoumnName);
	    		}
	    		
	    	}else{

	    		//is a table name
	    		$currentTableName  = $value;
	    		if(strlen(ltrim($currentTableName))<1){
					
	    		}else{
	    			$resultArray[$currentTableName] = array();
	    		
	    		}
	    		
	    	}

	    }

	    return json_encode($resultArray);
	}

	//the method below converts json to raw table data
	public static function convertJsonToRawTable($data){

		$array = json_decode($data);

		$resultString = "";

		foreach($array as $key => $value){
			$resultString.=$key."\n";
			foreach ($value as $key_child => $value_child) {
				$resultString.="	".$value_child."\n";
			}

			$resultString.="\n";
			$resultString.="\n";
			$resultString.="\n";
		}

		return $resultString;
	}

	//the method below deletes the data
	public function delete($id){
	    
		$doc = json_table::find($id);
		     
		$doc->delete();
	}
	//method to edit data
	public function editData(Request $request){
		    
		$json_table = json_table::find($request->input('id'));
		$json_data = $this->createTableJson($request->input('json_table_data')); 

		$json_table->json_table_data =$json_data;
		$json_table->database_name =$request->input('database_name');

		$json_table->save();
	}
	//method to validate data
	public function validate_form(Request $request){
		    
		$rules=array(

		        'json_table_data'=>'required',
		        'database_name'=>'required',

		      );
		$message=array(
		            'json_table_data'=>'Form is required.',
		            'database_name'=>'Form is required.',

		      );
		$this->validator=Validator::make($request->all(),$rules,$message);
		      if($this->validator->fails())
		      {
		        $request->session()->flash('validate_mode', 'true');
		        return false;
		      }
		      else
		      {
		        return true;
		      }

	}
		      
	private $validator = '';

	//show edit form
	public function showAddForm(Request $request){

	        return view('json_database.json_database_add_form');
	}

	//show edit form
	public function showEditForm($id){
			$json_table = json_table::find($id);
	        
	        $rawTableData = $this->convertJsonToRawTable($json_table->json_table_data);
	        $json_table->json_table_data =  $rawTableData;
	        return view('json_database.json_database_edit_form', 
	        ['json_table_data'=>$json_table ]
	        );
	}

	//the method below shows the list
	public function showList(Request $request){

		$json_data_lsit = json_table::all();
		return view('json_database.json_database_list', 
	        ['json_table_list'=>$json_data_lsit]);
	}


}