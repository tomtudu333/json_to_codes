@extends('layouts.app')
$section('title')
<title>Laravel code gen</title>
$endsection

@section('content')

<br><br><br><br>
<div class="container">

    <form action="{{ url('/') }}/json_database/edit_data" method="post" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="hidden" name="id" value="@if(Session::has('validate_mode')) {{ old('id')  }} @else{{ $json_table_data->id }} @endif">
            <div class="row">

               <div >
                <b> Database Structure : </b> 
                <textarea name="json_table_data" id="json_table_data_field" style="width:700px; height:700px;">@if(Session::has('validate_mode')) {{ old('json_table_data')  }} @else{{ $json_table_data->json_table_data }} @endif</textarea>

              </div>


              <div ><b> Database Name : </b> <input type="text" name="database_name" id="database_name_field" value="@if(Session::has('validate_mode')) {{ old('database_name')  }} @else{{ $json_table_data->database_name }} @endif"></div>
              <br>
              <button type="submit" class="btn btn-primary" id="add_btn">ADD</button>
            </div>


        </form >

</div>
<br><br>
Here the line ends !
@endsection
