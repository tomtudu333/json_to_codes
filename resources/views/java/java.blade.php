@extends('layouts.app')

$section('title')
<title>Java code gen</title>
$endsection

@section('content')

<br><br><br><br>
<div class="container">


  <div class="container">

    <div class="row">
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
    <br>
<div class="row">
  <div class="col-lg-2">
    <button id="get_code" class="btn btn-sm btn-primary">Get code</button>
  </div>
  <div class="col-lg-4">
    <select class="form-control" id="functionality">
      <option>dataCorrect</option>
      <option>saveData</option>
      <option>createTableInfoCodes</option>
      <option>getFormView</option>
    </select>
  </div>
</div>

<div class="row">
  <div class="col-lg-2">
    <button id="get_resultstring" class="btn btn-sm btn-primary">Get resultstring</button>
  </div>
  <div class="col-lg-4">
    <select class="form-control" id="functionality_resultstring">
      <option>convertPhpStringToResultStringWithVar</option>
      <option>convertPhpStringToResultString</option>
      <option>convertJScriptToResultStringWithVar</option>
      <option>convertPhpStringToResultStringWithVarFOLO</option>
    </select>
  </div>
  <div  id="hint" class="col-lg-6">

  </div>
</div>
<div class="container">
  <div id="usage_div"></div>
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


        //button click function
        $('#get_code').on('click',function(){

          console.log("The input code : "+editor.getValue());
          //editor_output.setValue(editor.getValue());

          postJsonAndGetJavaCodes();

        });


                $("#functionality").on('change',function(e){

                  console.log("Change event executed !");
                setUsageSample();

                });

                setUsageSample();

                //the method below sets the usage sample
                function setUsageSample(){

                  var selected_functionality = $('#functionality').val();

                  var usageSample = "";

                  switch (selected_functionality) {
                    case "dataCorrect":
                    usageSample = '{"editText":"something","spinner":"sSpinner","datePicker":"dPicker","timePicker":"tPicker"}';
                    break;

                    case "saveData":
                    usageSample = '{"editText":"something","spinner":"sSpinner","datePicker":"dPicker","timePicker":"tPicker"}';
                    break;

                    //createTableInfoCodes
                    case "createTableInfoCodes":
                    usageSample = '{"tableName":"something","databaseName":"something","cols": {"0":"some","1":"cols"}}';
                    break;

                    //<option>getFormView</option>
                    case "getFormView":
                    usageSample = '{"fields":{'+'\n'+
    '"0":{"fieldName":"someName","fieldType":"editText"},'+'\n'+
     '"1":{"fieldName":"someName","fieldType":"editText"}'+'\n'+

'}}';
                    break;

                    default:

                  }

                //{"functionPath":"some\\thing\\functionName"}
                if(selected_functionality){}

                editor.setValue(usageSample);
                }




        //the method below posts the json array and get the codes
        function postJsonAndGetJavaCodes(){

          var json_value = editor.getValue();
          var selected_functionality = $('#functionality').val();
          console.log("The selected functionalitu : "+selected_functionality);
$.ajaxSetup({
    global: false,
    type: "POST",
    url: "{{ url('/') }}/java/get_codes",
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
    , json : json_value,
      selected_functionality: selected_functionality},
    success: function (data) {
      //console.log("Results from the ajax request are as follows : ");
        //            console.log(data);
      editor_output.setValue(data);
    }
});


        }


        $("#get_resultstring").on('click',function(){

          postStringToGetMultilineResultString();

        });

        $("#functionality_resultstring").on('change',function(){
            setHintForResultstring();
        });
        setHintForResultstring();
        //the method below sets the hint for the result string
        function setHintForResultstring(){
          var selected_functionality = $('#functionality_resultstring').val();



            switch (selected_functionality) {
              case 'convertPhpStringToResultStringWithVar':
                  $("#hint").html("For varialble name, type - $var$");
              break;

              case 'convertPhpStringToResultString':
                  $("#hint").html("No hint available");
              break;
              //convertPhpStringToResultStringWithVarFOLO
              case 'convertPhpStringToResultStringWithVarFOLO':
                  $("#hint").html("No hint available");
              break;
              default:

            }
        }

        //the method below posts string to get multiline resultString
        function postStringToGetMultilineResultString(){

          var selected_functionality = $('#functionality_resultstring').val();

          var url = "";
          switch (selected_functionality) {
            case "convertPhpStringToResultStringWithVar":
            url = "{{ url('/') }}/java/get_multiline_resultstring_withvar";

            break;

            case "convertPhpStringToResultString":
            url = "{{ url('/') }}/java/get_multiline_resultstring";
            break;

            //get_multiline_resultstring_js
            case "convertJScriptToResultStringWithVar":
            url = "{{ url('/') }}/java/get_multiline_resultstring_js";
            break;

            case "convertPhpStringToResultStringWithVarFOLO":
            url = "{{ url('/') }}/java/convert_php_string_to_resultstring_with_var_folo";
            break;



            default:

          }


          var string = editor.getValue();
          $.ajaxSetup({
              global: false,
              type: "POST",
              url: url,
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
              , string : string},
              success: function (data) {
                //console.log("Results from the ajax request are as follows : ");
                  //            console.log(data);
                editor_output.setValue(data);
              }
          });

        }
    </script>

  </div>

</div>
<br><br>
Here the line ends !
@endsection
