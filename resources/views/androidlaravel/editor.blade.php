@extends('layouts.app')

$section('title')
<title>Androidlaravel code gen</title>
$endsection;
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
  <div class="col-lg-2">
    <select class="form-control" id="functionality">
      <option>getRouteFunctionandAjax</option>
      <option>getRouteAndFunctionAndJavaCode</option>
      <option>getRouteFunctionJavacodeforEditing</option>
      <option>getAjaxHtmlFormCode</option>
      
      <option>other</option>
    </select>
  </div>
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

            case "getRouteFunctionandAjax":
            usageSample = "No code required, have fun !";
            break;

            case "getRouteAndFunctionAndJavaCode":

            usageSample+='{"className":"someClassName","functionName":"somFunction",'+"\n";
            usageSample+='"fields":{"0":"fieldOne","2":"fieldTwo"}}'+"\n";

            break;

            //getRouteFunctionJavacodeforEditing
            case "getRouteFunctionJavacodeforEditing":
            usageSample+='{"className":"someClassName","functionName":"somFunction",'+"\n";
            usageSample+='"fields":{"0":"fieldOne","2":"fieldTwo"}}'+"\n";
            break;

            case "getAjaxHtmlFormCode":
            usageSample+='{"vars": {"0":"some","1":"cols"}}'+"\n";
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

      url: "{{ url('/') }}/androidlaravel/get_codes",

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

    </script>

  </div>

</div>
<br><br>
Here the line ends !
@endsection
