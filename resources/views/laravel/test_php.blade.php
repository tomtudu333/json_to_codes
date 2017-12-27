@extends('layouts.app')
$section('title')
<title>Php S code tester</title>
$endsection
@section('content')
<div class="container">

  <div class="row">
    <h3>For more details on output, <a href="{{ url('/') }}/phpcodetest/phpcodetest/test">click here</a></h3>
    <div class="col-lg-6">
      <b>Input code :-</b>
          <div id="editor" style="height: 300px; width: 100%;">{"editText":"something"}</div>

    </div>
    <div class="col-lg-6">

      <b>Output code :-</b>
          <div id="editor_output" style="height: 300px; width: 100%;">function foo(items) {
              var x = "All this is syntax highlighted";
              return x;
          }</div>
    </div>
  </div>
  <div id='console_div'></div>


</div>
  <script src="{{ url('/') }}/js/ace/ace.js"></script>
<script>
var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/javascript");

///for output code
var editor_output = ace.edit("editor_output");
editor_output.setTheme("ace/theme/monokai");
editor_output.getSession().setMode("ace/mode/javascript");


editor.on("input", function() {
    //saveButton.disabled = editor.session.getUndoManager().isClean()

    var editor_content = editor.getValue();
    //console.log(editor_content);
    sendPhpCodes();
    executePhpCodeTest();

});

//the method below sends the php code to function, which executes it and
//returns the value
function sendPhpCodes(){

  var phpcode = editor.getValue();
  $.ajaxSetup({
      global: false,
      type: "POST",
      url: "{{ url('/') }}/laravel/test_php_code",
      beforeSend: function () {
         //$(".modal").show();
         //console.log("Sending started...");
      },
      complete: function () {
          //$(".modal").hide();
        //  console.log("Sent complete !");
      }

  });// _token: '{{ csrf_token() }}'
  $.ajax({
      data:{_token: '{{ csrf_token() }}'
      , php_code : phpcode},
        statusCode: {
            500: function() {
                //alert(" 500 data still loading");
                console.log('500 ');
                $('#console_div').html('<b style="color:red;">Getting 500 error</b>');
            }
        },
      success: function (data) {
        //console.log("Results from the ajax request are as follows : ");
          //            console.log(data);
        //editor_output.setValue(data);
        $('#console_div').html('<b style="color:green;">Going fine</b>');

      }

  });

}

//the method below executes the php code test and gets the output
function executePhpCodeTest(){
  $.ajaxSetup({
      global: false,
      type: "GET",
      url: "{{ url('/') }}/phpcodetest/phpcodetest/test",
      beforeSend: function () {
         //$(".modal").show();
         //console.log("Sending started...");
      },
      complete: function () {
          //$(".modal").hide();
        //  console.log("Sent complete !");
      }

  });// _token: '{{ csrf_token() }}'
  $.ajax({
      data:{_token: '{{ csrf_token() }}'},
        statusCode: {
            500: function() {
                //alert(" 500 data still loading");
                console.log('500 ');
                editor_output.setValue("Getting 500 error !");
                $('#console_div').html('<b style="color:red;">Getting 500 error</b>');
            }
        },
      success: function (data) {
        //console.log("Results from the ajax request are as follows : ");
          //            console.log(data);
        editor_output.setValue(data);
        $('#console_div').html('<b style="color:green;">Going fine</b>');

      }

  });
}

 writeInitCode();
//the method below writes the initial code
function writeInitCode(){
  var resultString = "";

  resultString+='<?php'+"\n";
resultString+=''+"\n";
resultString+='namespace App\\Http\\Controllers\\Phpcodetest;'+"\n";
resultString+=''+"\n";
resultString+='use Illuminate\\Http\\Request;'+"\n";
resultString+='use App\\Http\\Controllers\\Controller;'+"\n";
resultString+=''+"\n";
resultString+='class Phpcodetest extends Controller'+"\n";
resultString+='{'+"\n";
resultString+='    //'+"\n";
resultString+=''+"\n";
resultString+='    public function test(){'+"\n";
resultString+=''+"\n";
resultString+='}'+"\n";
resultString+='}'+"\n";

editor.setValue(resultString);
}


</script>
@endsection
