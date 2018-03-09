<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/java', 'Java@java_main');

Route::get('/java/test', 'Java@test');


 

//post the json and output java code
Route::post('/java/get_codes','Java@getJavaCode');

Route::post('/java/get_multiline_resultstring','Java@convertPhpStringToResultString');
Route::post('/java/get_multiline_resultstring_withvar','Java@convertPhpStringToResultStringWithVar');
Route::post('/java/get_multiline_resultstring_js','Java@convertJScriptToResultStringWithVar');
Route::post('/java/convert_php_string_to_resultstring_with_var_folo','Java@convertPhpStringToResultStringWithVarFOLO');


Route::get('/mastercodegenerator/test', 'Mastercodegenerator@test_function');

Route::get('/mastercodegenerator', 'Mastercodegenerator@mastercodegenerator_main');
//post for master code generator
Route::post('/mastercodegenerator/get_codes','Mastercodegenerator@getCode');

 


//the editor panel
Route::get('/laravel','Laravel@laravel_main');
//post method to get the codes
Route::post('/laravel/get_codes','Laravel@getLanguageCode');
//to test the functions in this package
Route::get('/laravel/test_functions','Laravel@test_function');




//the editor panel
Route::get('/androidlaravel','Androidlaravel@androidlaravel_main');
//post method to get the codes
Route::post('/androidlaravel/get_codes','Androidlaravel@getLanguageCode');
//to test the functions in this package
Route::get('/androidlaravel/test_function','Androidlaravel@test_function');



//execute the test function created
Route::get('/phpcodetest/phpcodetest/test','phpcodetest\Phpcodetest@test');

Route::get('/laravel/test_php','Laravel@test_php');

Route::post('/laravel/test_php_code','Laravel@testPhpCode');

//route


Route::get('/jsonapibacktrack','Jsonapibacktrack@Jsonapibacktrack_main');
//post method to get the codes
Route::post('/jsonapibacktrack/get_codes','Jsonapibacktrack@getLanguageCode');
//to test the functions in this package
Route::get('/jsonapibacktrack/test_functions','Jsonapibacktrack@test_function');


//route

//the editor panel
Route::get('/opencart','Opencart@opencart_main');
//post method to get the codes
Route::post('/opencart/get_codes','Opencart@getLanguageCode');
//to test the functions in this package
Route::get('/opencart/test_functions','Opencart@test_function');


//the editor panel
Route::get('/yii_framework','Yii_framework@yii_framework_main');
//post method to get the codes
Route::post('/yii_framework/get_codes','Yii_framework@getLanguageCode');
//to test the functions in this package
Route::get('/yii_framework/test_functions','Yii_framework@test_function');





//the site map
Route::get('/laravel/site_map','Laravel@site_map');

Route::get('/laravel/test',function(){

	return view('welcome',["records"=>["some","array"]]);
});


