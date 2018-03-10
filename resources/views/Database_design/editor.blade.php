@extends('layouts.app')
$section('title')
<title>Laravel code gen</title>
$endsection

@section('content')

<div class="container">

<div class="container" style="padding-bottom: 10px;">
  
      <div class="row">
        <div class="col-lg-6">
                    <h2>Select database and tables</h2>
          <div class="row">
            <div class="col-lg-2"><b>Select database</b></div>
            <div class="col-lg-2">
              <select id="select_database">
                @foreach($databases as $data)
                <option database_id="{{ $data->id }}" database_json="{{ $data->json_table_data }}">{{ $data->database_name }}</option>
                @endforeach
              </select>
            </div>
          </div>

            <div class="row">
            <div class="col-lg-2"><b>Select Table</b></div>
            <div class="col-lg-2">
                <select id="table_list">
                  <option>Please select</option>
                  <option>Option Two</option>
                </select>
              </div>
            </div>

        </div>
        <div class="col-lg-6">
          <h2>COLOUMNS</h2>
          <input type="hidden" name="col_list" id="col_list_hidden" value="">
          <div id="coloumn_list">
            
          </div>
        </div>
      </div>
</div>
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
  <div class="col-lg-5">
    <select  id="functionality" class="form-control">
      <option>getCode</option>
    </select>
  </div>
</div>
<div class="container">
  <div id="usage_div"></div>
</div>


  <script src="{{ url('/') }}/js/ace/ace.js"></script>

    <script>



        $("#select_database").on("change",function(){

          var json = $(this).children(":selected").attr("database_json");

          console.log(json);
          setTableList(json);


        });

        $("#table_list").on("change",function(){
            getColoumnList();

        });




        //the method below sets the table options
        function setTableList(json_string){

          var tableObj = JSON.parse(json_string);

          $("#table_list").html("");
          
          for(var key in tableObj){
            console.log(key);

            var text = document.createTextNode(key);
            var option = document.createElement("option");
            option.appendChild(text);
            $("#table_list").append(option);
          }
        }


        $("#col_names").on("click",function(){
            getColoumnList();
        });

        //the method below gets the coloumn list
        function getColoumnList(){

          var json = $("#select_database").children(":selected").attr("database_json");

          var object = JSON.parse(json);

          var tableName = $("#table_list").val();

          console.log("The table name - "+tableName);

          coloumnList = object[tableName];

          console.log(coloumnList);

          setColoumnList(coloumnList);

        }

        //the method below sets the coloumn list
        function setColoumnList(array){

          $("#col_list_hidden").val(JSON.stringify(array));
          $("#coloumn_list").html("");
          console.log("Strigified value - "+$("#col_list_hidden").val());
          for(var i =0;i<array.length;i++){
            var textNode = document.createTextNode(array[i]);

            var bNode = document.createElement("b");
            bNode.appendChild(textNode);
            var br = document.createElement("br");

            $("#coloumn_list").append(bNode);
            $("#coloumn_list").append(br);
          }
        }

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

            case "getCode":
            usageSample = '{"table_name":"my_table", "cols":["some","cols","names"], "main_route":"some_route"}';
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

                  console.log("The json Value"+json_value);

                  var selected_functionality = $('#functionality').val();

                  console.log("The selected functionality : "+selected_functionality);

        $.ajaxSetup({

            global: false,

            type: "POST",

            url: "{{ url('/') }}/Database_design/get_codes",

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

            , json : $("#col_list_hidden").val(),
            code:json_value,

              selected_functionality: selected_functionality},
              statusCode: {
                  500: function() {
                      alert(" 500 data still loading");
                      console.log('500 ');
                  }
              },
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